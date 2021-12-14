<?php

namespace App\Http\Controllers;

use App\Mail\AdminAdded;
use App\Mail\AssociateAdded;
use App\Models\Admin;
use App\Models\Associate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
  public function addAssociate(Request $request)
  {
    $associate=new Associate;
    $associate->name=$request->name;
    $associate->email=$request->email;
    $associate->save();
    $user=new User();
    $user->name=$associate->name;
    $user->email=$associate->email;
    $password=Str::random(8);
    $user->password=Hash::make($password);
    $user->save();
    Mail::to($associate)->send(new AssociateAdded($associate->email,$password));
    return response()->json(['message'=>'doctor approved successfully']);
  } 
  public function addAdmin(Request $request)
  {
    $admin=new Admin;
    $admin->name=$request->name;
    $admin->email=$request->email;
    $admin->save();
    $password=Str::random(8);
    $user=new User();
    $user->name=$admin->name;
    $user->email=$admin->email;
    $user->pasword=Hash::make($password);
    $user->save();
    Mail::to($admin)->send(new AdminAdded($admin->email,$password));
    return response()->json(['message'=>'doctor approved successfully']);
  }     
}
