<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\SuggestionController;

Route::get('/',[UserController::class,'welcome']);

Auth::routes();

Route::get('/admin',function(){
  return view('admin.adminhome');
});

Route::get('/login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback',LoginController::class,'handleGoogleCallback');
Route::get('/login/facebook',[LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback',LoginController::class,'handleFacebookCallback');

Route::get('/languages',[UserController::class,'languages']);
Route::get('/allusers',[UserController::class,'allusers']);
Route::get('/allassociates',[AssociateController::class,'allAssociates']);
Route::get('/navigation',[UserController::class,'navigation']);
Route::get('/evaluations',[SuggestionController::class,'evaluations']);
Route::get('/home',[UserController::class,'home'])->name('home');
Route::post('/search',[UserController::class,'search'])->name('search');
Route::get('user/data',[UserController::class,'data']);

Route::prefix('doctor')->group(function(){
  Route::get('approveddoctors',[DoctorController::class,'approvedDoctors']);
  Route::get('pendingdoctors',[DoctorController::class,'pendingDoctors']);
  Route::get('claimprofile',[DoctorController::class,'getClaimProfile']);
  Route::post('claimprofile',[DoctorController::class,'postClaimProfile']);
  Route::get('data',[DoctorController::class,'data']);
  Route::get('profile/{id}',[DoctorController::class,'profile'])->name('doctor.profile');
  Route::get('profile/{id}/edit',[DoctorController::class,'editprofile']);
  Route::post('profile/update',[DoctorController::class,'updateprofile'])->name('doctorprofile.update');
  Route::post('/addSpeciality',[DoctorController::class,'addSpeciality']);
  Route::get('rate',[DoctorController::class,'getrate']);
  Route::get('averagerate',[DoctorController::class,'averagerate']);
  Route::post('rate',[DoctorController::class,'postrate']);
  Route::get('/rating',[DoctorController::class,'rating']);
  Route::get('/aboutme',[DoctorController::class,'aboutme']);
  Route::get('/hospitals',[DoctorController::class,'hospitals']);
  Route::post('search',[DoctorController::class,'search'])->name('doctor.search');
  Route::get('register',[DoctorController::class,'getRegister']);
  Route::post('register',[DoctorController::class,'postRegister'])->name('doctor.register');
  Route::post('approve',[DoctorController::class,'approve']);
  Route::post('/edit/{id}',[DoctorController::class,'edit']);
  Route::post('/delete',[DoctorController::class,'delete']);
  Route::get('emails',[DoctorController::class,'emails']);
});

Route::get('/findhospitals',[HospitalController::class,'findhospitals']);
Route::get('/finddoctors',[DoctorController::class,'finddoctors']);
Route::get('/alldoctors',[DoctorController::class,'alldoctors']);
Route::get('allhospitals',[HospitalController::class,'allhospitals']);
Route::get('/allspecialities',[SpecialityController::class,'allspecialities']);

Route::prefix('speciality')->group(function(){
  Route::post('add',[SpecialityController::class,'add']);
  Route::get('search',[SpecialityController::class,'search']);
  Route::get('/{id}',[SpecialityController::class,'speciality']);
});

Route::prefix('hospital')->group(function(){ 
  Route::get('approvedhospitals',[HospitalController::class,'approvedHospitals']);
  Route::get('pendinghospitals',[HospitalController::class,'pendingHospitals']);
  Route::post('search',[HospitalController::class,'search'])->name('hospital.search');
  Route::get('profile/{id}',[HospitalController::class,'profile']);
  Route::get('profile/{id}/edit',[HospitalController::class,'editprofile'])->name('hospital.editprofile');
  Route::get('averagerate',[HospitalController::class,'averagerate']);
  Route::get('register',[HospitalController::class,'getregister'])->name('hospital.register');
  Route::post('register',[HospitalController::class,'postregister']);
  Route::post('approve',[HospitalController::class,'approve']);
  Route::get('/edit/{id}',[HospitalController::class,'edit']);
  Route::post('/delete',[HospitalController::class,'delete']);
  Route::get('data',[HospitalController::class,'data']);
  Route::get('emails',[HospitalController::class,'emails']);
});

Route::prefix('associate')->group(function(){
  Route::get('myprofile',[AssociateController::class,'myprofile']);
  Route::post('adddoctor',[AssociateController::class,'addDoctor']);
  Route::post('addhospital',[AssociateController::class,'addHospital']);
  Route::post('addSpeciality',[AssociateController::class,'addSpeciality']);
  Route::post('city/add',[CityController::class,'addVerifiedCity']);
});

Route::prefix('admin')->group(function(){
  Route::post('addadmin',[AdminController::class,'addAdmin']);
  Route::post('addassociate',[AdminController::class,'addAssociate']);
});

Route::prefix('city')->group(function(){
  Route::get('all',[CityController::class,'allCities']);
  Route::post('add',[CityController::class,'addCity']);
  Route::get('/{id}/hospitals',[CityController::class,'findHospitals']);
});