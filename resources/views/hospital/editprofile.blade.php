@extends('layouts.app')
@section('content')
 <div class="w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 mx-auto my-3 rounded-3xl p-3 bg-white">
  <h2 class="text-center text-tiruhakim text-3xl border-b-2 border-gray-300 p-2">submit the form below to edit profile</h2>
  <form method="POST" action="{{route('hospital.editprofile')}}" enctype="multipart/form-data" class="mx-3 my-2">
    @csrf
   <label for="name" class="text-2xl text-tiruhakim">full name</label>
   <input type="text" name="name" value="{{$hospital->name}}" placeholder="full name" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   @if($errors->has('name'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$error->first('name')}}</p>
   @endif
   <label for="email" class="text-2xl text-tiruhakim">email</label>
   <input type="email" name="email" value="{{$hospital->email}}" placeholder="email" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   @if($errors->has('email'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$error->first('email')}}</p>
   @endif
   <p>
     <img src="/storage/hospitals/{{$hospital->picture}}" class="w-40 m-2">
    <label for="picture" class="text-2xl text-tiruhakim m-1">hospital photo</label>
    <input type="file" name="picture" required class="text-xl bg-tiruhakim text-white"/>
   </p>
   @if ($errors->has('picture'))
     <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('picture')}}</p>
   @endif
   <p>
    <label for="location" class="text-2xl text-tiruhakim m-1">location</label>
    <input type="text" name="location" value="{{$hospital->location}}" placeholder="location" class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   </p>
   @if($errors->has('location'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('location')}}</p>
   @endif
   <p>
   <label class="text-2xl text-tiruhakim">description<span class="text-gray-500">(hospital description)<span></label>
   <input type="text" name="city" value="{{$hospital->description}}"placeholder="hospital description" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   </p>
   @if($errors->has('description'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('description')}}</p>
   @endif
   <label class="text-2xl text-tiruhakim tiruhakim">phone number</label>
   <input type="number" name="phone_number" value="{{$hospital->phone_number}}" placeholder="phone number" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   @if($errors->has('phone_number'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('phone_number')}}</p>
   @endif
   <input type="submit" value="claim a profile" class="my-3 mx-6 py-2 px-3 rounded-3xl text-xl bg-tiruhakim text-white p-1">
  </form>
 </div>
@endsection