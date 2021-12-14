<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\Rate;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function allspecialities()
    {
      $specialities=Speciality::all();
      return response()->json(['specialities'=>$specialities]);
    }
    public function add(Request $request)
    {
      $name=$request->name;
      $speciality=new Speciality();
      $speciality->name=$name;
      if($request->status){
        $speciality->status='approved';
      }
      $speciality->save();
      return response()->json(['message'=>'success']);
    }
    public function speciality($id)
    {
      return view('doctors',['specialityId'=>$id]);
    }
    public function search(Request $request)
    {
      $speciality=Speciality::find($request->specialityId);
      $doctors=Doctor::all();
      return response()->json(['speciality'=>$speciality,'doctors'=>$doctors]);
    }
}
