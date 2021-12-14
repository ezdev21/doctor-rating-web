<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Language;
use App\Models\Speciality;
use Illuminate\Http\Request;

class AssociateController extends Controller
{
  public function allAssociates()
  {
    $associates=Associate::all();
    return response()->json(['associates'=>$associates]);
  }
  public function myProfile(Request $request)
  {
   $doctor=Doctor::find($request->doctorId);
   return response()->json(['doctor'=>$doctor]); 
  }
  public function addDoctor(Request $request)
  {
    $doctor=new Doctor;
    $doctor->name=$request->name;
    $doctor->email=$request->email;
    $doctor->phone_number=$request->phoneNumber;
    if($request->hospital){
      $doctor->hospital=$request->hospital;
    }
    $doctor->age=$request->age;
    $doctor->description=$request->description;
    $doctor->gender=$request->gender;
    $doctor->experience=$request->experience;
    $doctor->avatar="avatar";
    $doctor->status="approved";
    $doctor->save();
    $hospitalId=$request->hospitalId;
    if($request->hospitalId){
      foreach ($hospitalId as $id) {
        $hospital=Hospital::find($id);
        $doctor->hospitals()->attach($hospital);
      }
    }
    if($request->specialities){
      foreach ($request->specialities as $id) {
        $speciality=Speciality::find($id);
        $doctor->specialities()->attach($speciality);
      }
    }
    if($request->languages){
      foreach ($request->languages as $id) {
        $language=Language::find($id);
        $doctor->languages()->attach($language);
      }
    }
    if($request->file){
      $doctor->avatar=$doctor->id.'.'.$request->file->extension();
      $doctor->save();
      $request->file->storeAs('doctors',$doctor->avatar,'public');
    }
  }
  public function addHospital(Request $request)
  {
    $hospital=new Hospital();
    $hospital->name=$request->name;
    $hospital->description=$request->description;
    $hospital->city_id=$request->city;
    $hospital->location=$request->location;
    $hospital->phone_number=$request->phoneNumber;
    $hospital->email=$request->email;
    $hospital->status="approved";
    $hospital->save();
    $hospital->picture=$hospital->id.'.'.$request->file->extension();
    $hospital->save();
    $request->file->storeAs('hospitals',$hospital->picture,'public');
    $request->file->storeAs('hospitals',$hospital->picture,'public');
  }
  public function addSpeciality(Request $request)
  {
    $speciality=new Speciality;
    $speciality->name=$request->speciality;
    $speciality->status='approved';
    $speciality->save();
    return response()->json(['message'=>'new speciality added successfuly']);
  }  
}
