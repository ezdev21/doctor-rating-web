<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hospital;
use Illuminate\Http\Request;

class CityController extends Controller
{
  public function allCities()
  {
    $cities=City::where('status','approved')->get();
    return response()->json(['cities'=>$cities]);   
  }
  public function addCity(Request $request)
  {
   $name=$request->cityName;
   $city=new City();
   $city->name=$name;
   $city->status="pending";
   $city->save();
   return response()->json(['city'=>$city]);
  }
  public function addVerifiedCity(Request $request)
  {
   $name=$request->cityName;
   $city=new City();
   $city->name=$name;
   $city->status="approved";
   $city->save();
   return response()->json(['city'=>$city]);
  }  
  public function findHospitals($id)
  {
    $city=City::find($id);
    $hospitals=$city->hospitals;
    return view('cityhospitals',['city'=>$city,'hospitals'=>$hospitals]);
  }
  public function hospitals()
  {
    return $this->hasMany(Hospital::class);
  }
}
