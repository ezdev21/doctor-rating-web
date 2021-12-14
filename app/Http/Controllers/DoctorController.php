<?php

namespace App\Http\Controllers;
use App\Models\Rate;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Language;
use App\Models\User;
use App\Models\Preview;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\DoctorApproved;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
   public function finddoctors()
   { 
      return view('finddoctor'); 
   }
   public function approvedDoctors()
   {
     $doctors=Doctor::where('status','approved')->get();
     return response()->json(['doctors'=>$doctors]);
   }
   public function pendingDoctors()
   {
    $doctors=Doctor::where('status','pending')->get();
    return response()->json(['doctors'=>$doctors]);
   }
   public function data(Request $request)
   {
     $doctor=Doctor::find($request->doctorId);
     return response()->json(['doctor'=>$doctor]);
   }
   public function profile($id)
   {
    $doctor=Doctor::find($id);
    return view('doctorprofile',['doctor'=>$doctor]);
   } 
   public function rating(Request $request)
   {
     $doctor=Doctor::find($request->doctorId);
     return response()->json(['doctor'=>$doctor]);
   }
   public function averagerate(Request $request)
   {
     $totalrate=0;
     $rates=Rate::where('doctor_id',$request->doctorId)->where('type','doctor')->get();
     $doctors=Doctor::all();
     foreach($rates as $rate){ 
      if(!$rate->name){
        $totalrate+=$rate->star*0.75;
      }
      else{
         $doctor=Doctor::where('email',$rate->email);
         if($doctor){
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
   public function postrate(Request $request)
   { 
     $star=$request->rate;
     $comment=$request->comment;
     $name=$request->name;
     $phone=$request->phone;
     $email=$request->email;
     $rate=new Rate();
     $rate->type='doctor';
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
   public function getpreview(Request $request)
   {
      $previews=Rate::where('doctor_id',$request->doctorId)->get();
      return response()->json(['previews'=>$previews]);
   }
   public function postpreview(Request $request)
   {
    $preview=new Preview;
    $preview->user_id=$request->userId;
    $preview->video_id=$request->videoId;
    $preview->comment=$request->comment;
    $preview->save();
    $preview->user=User::find($request->userId);
    $preview->save();
    return response()->json(['preview'=>$preview]);
   }
   public function rate(Request $request)
   {
    $userId=$request->userId;
    $doctorId=$request->doctorId;
    $rate=$request->rate;
    $user=User::find($userId);
    $doctor=doctor::find($doctorId);
    $user::syncWithoutDetaching($doctor,['rate'=>$rate]);
    //evaluation
    return response()->json(['message'=>'successful']);
   }
   public function getClaimProfile()
   {
     return view('doctor.claimprofile');
   }
   public function postClaimProfile(Request $request)
   {
     $doctor=Doctor::find($request->id);
     $user=new User();
     $user->email=$doctor->email;
     $user->name=$doctor->name;
     $email=$user->email;
     $password=Str::random(8);
     $user->password=$password;
     Mail::to($user)->send(new DoctorApproved($email,$password));
   }
   public function getRegister()
   {
    $specialities=Speciality::all();
    $languages=Language::all();
    $hospitals=Hospital::where('status','approved')->get();
    return view('doctor.doctorregister',compact('specialities','languages','hospitals'));
   }
   public function postRegister(Request $request)
   {   
    $doctor=new Doctor;
    $doctor->name=$request->name;
    $doctor->email=$request->email;
    $doctor->phone_number=$request->phoneNumber;
    if($request->hospital){
      $doctor->hospital=$request->hospital;
    }
    $doctor->status='pending';
    $doctor->age=$request->age;
    $doctor->description=$request->description;
    $doctor->gender=$request->gender;
    $doctor->experience=$request->experience;
    $doctor->avatar="avatar";
    $doctor->save();
    $hospitalId=explode(',',$request->hospitalId);
    $specialities=explode(',',$request->specialities);
    $languages=explode(',',$request->languages);
    if($hospitalId){
      foreach($hospitalId as $id) {
        $hospital=Hospital::find($id);
        $doctor->hospitals()->attach($hospital);
      }
    }
    if($specialities){
      foreach($specialities as $id) {
        $speciality=Speciality::find($id);
        $doctor->specialities()->attach($speciality);
      }
    }
    if($languages){
      foreach($languages as $id) {
        $language=Language::find($id);
        $doctor->languages()->attach($language);
      }
    }
    if($request->file){
      $doctor->avatar=$doctor->id.'.'.$request->file->extension();
      $doctor->save();
      $request->file->storeAs('doctors',$doctor->avatar,'public');
    }
    return redirect()->route('home');
   }
   public function alldoctors()
   {
      $doctors=Doctor::where('status','approved')->get();
      return response()->json(['doctors'=>$doctors]);
   }
   public function search(Request $request)
   {
    $query=$request->searchQuery;
    $doctors=Doctor::where("name","LIKE","%$query%")->get();
    return view('search.doctorsearch',['doctors'=>$doctors,'search_query'=>$query]);    
   }
   public function aboutme(Request $request)
   {
     $doctor=Doctor::find($request->doctorId);
     $specialities=$doctor->specialities;
     $languages=$doctor->languages;
     $experience=$doctor->experience;
     return response()->json(['experience'=>$experience,'languages'=>$languages,'specialities'=>$specialities]);
   }
   public function editprofile($id)
   {
     $doctor=Doctor::find($id);
     return view('doctor.editprofile',['doctor'=>$doctor]);
   }
   public function updateprofile(Request $request)
   {
    $doctor=Doctor::find($request->doctorTId);
    $doctor->name=$request->name;
    $doctor->email=$request->email;
    $doctor->phone_number=$request->phone_number;
    $doctor->hospital=$request->hospital;
    $doctor->age=$request->age;
    $doctor->description=$request->description;
    $doctor->gender=$request->gender;
    $doctor->experience=$request->experience;
    $doctor->avatar="avatar";
    $doctor->save();
    $doctor->specialities()->attach($request->specialities);
    $doctor->languages()->attach($request->languages);
    $doctor->avatar=$doctor->id.'.'.$request->avatar->extension();
    $doctor->save();
    $request->avatar->storeAs('doctors',$doctor->avatar,'public');
    return redirect()->route('home');    
   }
   public function hospitals(Request $request)
   {
     $doctor=Doctor::find($request->doctorId);
     $hospitals=$doctor->hospitals;
     return response()->json(['hospitals'=>$hospitals]);
   }
   public function addSpeciality(Request $request)
   {
     $speciality=new Speciality();
     $speciality->name=$request->specialityName;
     $speciality->status="pending";
     $speciality->save();
     return response()->json(['speciality'=>$speciality]);
   }
   public function approve(Request $request)
   {
    $doctor=Doctor::find($request->id);
    $doctor->status="approved";
    $doctor->save();
    $user=new User();
    $user->email=$doctor->email;
    $user->name=$doctor->name;
    $email=$user->email;
    $password=Str::random(8);
    $user->password=Hash::make($password);
    $user->save();
    Mail::to($user)->send(new DoctorApproved($email,$password));
    return response()->json(['message'=>'doctor approved successfully']); 
   }
   public function edit(Request $request)
   {
    $doctor=Doctor::find($request->id);
    return view('admin.doctoredit',['doctor'=>$doctor]);
   }
   public function delete(Request $request)
   {
     $doctor=Doctor::find($request->id);
     $doctor->delete();
     Storage::delete("/storage/doctors/{{$request->id}}");
     return response()->json(['message'=>'doctor removed successfully']);
   }
   public function emails()
   {
     $emails=[];
     $doctors=Doctor::all();
     foreach ($doctors as $doctor) {
       array_push($emails,$doctor->email);
     }
    return response()->json(['emails'=>$emails]);
   }
}