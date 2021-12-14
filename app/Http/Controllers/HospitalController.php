<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Speciality;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
  public function city()
  {
    return $this->belongsToMany(City::class);
  }
  public function allhospitals()
  {
    $hospitals=Hospital::where('status','approved')->get();
    return response()->json(['hospitals'=>$hospitals]);
  }
  public function approvedHospitals()
   {
     $hospitals=Hospital::where('status','approved')->get();
     return response()->json(['hospitals'=>$hospitals]);
   }
   public function pendingHospitals()
   {
    $hospitals=Hospital::where('status','pending')->get();
    return response()->json(['hospitals'=>$hospitals]);
   }
  public function findhospitals()
  {
    return view('findhospital');
  }
  public function postrate(Request $request)
  {
     $star=$request->rate;
     $comment=$request->comment;
     $name=$request->name;
     $phone=$request->phone;
     $email=$request->email;
     $rate=new Rate();
     $rate->type='hospital';
     $rate->star=$star;
     $rate->comment=$comment;
     $rate->email=$email;
     $rate->doctor_id=$request->doctorId;
     if($name){
      $rate->name=$name;
     }
     $rate->phone=$phone;
     $rate->save();
  }
  public function averagerate(Request $request)
  {
    $totalrate=0;
     $rates=Rate::where('hospital_id',$request->doctorId)->where('type','hospital')->get();
     $users=User::all();
     foreach($rates as $rate){ 
      if(!$rate->name){
        $totalrate+=$rate->star*0.75;
      }
      else{
         $user=User::where('email',$request->email);
         if($user){
           $totalrate+=$rate->star*1;
         }
         else{
           $totalrate+=$rate->star*0.85;
         }
      }
     }
     if($rates->count()!=0){
      $averagerate=$totalrate/$rates->count();
     }
     else{
       $averagerate=0;
     }
     return response()->json(['rate'=>$averagerate]);
  }
  public function hospitals()
  {
      return view('hospitals');
  }
  public function getregister()
  {
    $cities=City::all();
    return view('hospital.claimprofile',['cities'=>$cities]);
  }
  public function data(Request $request)
  {
    $hospital=Hospital::find($request->hospitalId);
    $doctors=$hospital->doctors;
    return response()->json(['hospital'=>$hospital,'doctors'=>$doctors]);
  }
  public function postregister(Request $request)
  {
    $hospital=new Hospital();
    $hospital->name=$request->name;
    $hospital->description=$request->description;
    $hospital->city_id=$request->city;
    $hospital->location=$request->location;
    $hospital->phone_number=$request->phoneNumber;
    $hospital->email=$request->email;
    $hospital->status="pending";
    $hospital->save();
    $hospital->picture=$hospital->id.'.'.$request->file->extension();
    $hospital->save();
    $request->file->storeAs('hospitals',$hospital->picture,'public');
    return redirect()->route('home');
  }
  public function profile($id)
  {
    $hospital=Hospital::find($id);
    return view('hospitalprofile',['hospital'=>$hospital]);
  }
  public function search(Request $request)
  {
    $query=$request->searchQuery;
    $hospitals=Hospital::where("name","LIKE","%$query%")->get();
    return view('search.hospitalsearch',['hospitals'=>$hospitals,'search_query'=>$query]);
  }  
  public function approve(Request $request)
   {
    $hospital=Hospital::find($request->id);
    $hospital->status="approved";
    $hospital->save();
    return response()->json(['message'=>'hospital approved successfully']); 
   }
  public function edit(Request $request)
  {
    $hospital=Hospital::find($request->id);
    return view('hospital.editprofile',['hospital'=>$hospital]);
  }
  public function delete(Request $request)
  {
     $hospital=Hospital::find($request->id);
     $hospital->delete();
     Storage::delete("/storage/hospitals/$request->id");
     return response()->json(['message'=>'hospital successfully removed']);
  }
  public function emails()
  {
    $emails=[];
    $hospitals=Hospital::all();
    foreach ($hospitals as $hospital) {
       array_push($emails,$hospital->email);
     }
    return response()->json(['emails'=>$emails]);
  }
}
