<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Associate;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Language;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function allusers()
  {
   $users=User::all();
   return response()->json(['users'=>$users]); 
  }
  public function search(Request $request)
  {
    $query=$request->searchQuery;
    $doctors=Doctor::where("name","LIKE","%$query%")->get();
    $hospitals=Hospital::where("name","LIKE","%$query%")->get();
    return view('search.homesearch',['doctors'=>$doctors,'hospitals'=>$hospitals,'search_query'=>$query]); 
  }
  public function home()
  {
    if(auth()->user()){
      $admin=Admin::where('email',auth()->user()->email)->first();
      if($admin){
        return view('admin.adminhome',['admin'=>$admin]);
      }
      else{
        $associate=Associate::where('email',auth()->user()->email)->first();
        if($associate){ 
        return view('associateprofile',['associate'=>$associate]);
        }
        else{
          $doctor=Doctor::where(['email',auth()->user()->email],['status','approved'])->first();
          if($doctor){
            $previews=Rate::where('doctor_id',$doctor->id)->get();
            return view('doctor.doctorhome',['doctor'=>$doctor,'previews'=>$previews]);
          }
          else{
            $totaldoctors=Doctor::all()->count();
            $totalhospitals=Hospital::all()->count();
            $totaldoctors+=$totalhospitals;
            $totalusers=User::all()->count();
            $totalreviews=Rate::all()->count();
            return view('welcome',compact('totaldoctors','totalusers','totalreviews'));
          }
        }
      }
    }
    else{
       $totaldoctors=Doctor::all()->count();
       $totalhospitals=Hospital::all()->count();
       $totaldoctors+=$totalhospitals;
       $totalusers=User::all()->count();
       $totalreviews=Rate::all()->count();
       return view('welcome',compact('totaldoctors','totalusers','totalreviews'));
    }
  }
  public function navigation(Request $request)
  {
    $user=User::find($request->userId);
    $isAdmin=in_array($user->email,['getachewfikadu77@gmail.com']);
    return response()->json(['user'=>$user,'isAdmin'=>$isAdmin]);  
  }
  public function welcome()
  {
    $totaldoctors=Doctor::all()->count();
    $totalhospitals=Hospital::all()->count();
    $totaldoctors+=$totalhospitals;
    $totalusers=User::all()->count();
    $totalreviews=Rate::all()->count();
  if($totaldoctors>=1000){
    $totaldoctors=$totaldoctors/1000;
    $totaldoctors=$totaldoctors."K+";
  }
  if($totaldoctors>=1000000){
    $totaldoctors=$totaldoctors/1000000;
    $totaldoctors=$totaldoctors."M+";
  }  
  if($totalusers>=1000){
    $totalusers=$totalusers/1000;
    $totalusers=$totalusers."K+";
  }
  if($totalusers>=1000000){
    $totalusers=$totalusers/1000000;
    $totalusers=$totalusers."M+";
  }
  if($totalreviews>=1000){
    $totalreviews=$totalreviews/1000;
    $totalreviews=$totalreviews."K+";
  }
  if($totalreviews>=1000000){
    $totalreviews=$totalreviews/1000000;
    $totalreviews=$totalreviews."M+";
  }
    return view('welcome',compact('totaldoctors','totalusers','totalreviews'));
  }
  public function languages()
  {
    $languages=Language::all();
    return response()->json(['languages'=>$languages]);
  }
  
}