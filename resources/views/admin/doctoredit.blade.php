@extends('layouts.app')
@section('content')
 <div class="w-full lg:w-1/2 xl:w-1/2 2xl:w-1/2 mx-auto my-3 rounded-3xl p-3 bg-white">
  <h2 class="text-center text-tiruhakim text-3xl border-b-2 border-gray-300 p-2">submit the form below to edit profile</h2>
  <form action="" class="mx-3 my-2">
   <input type="hidden" name="doctorId" value="{{$doctor->id}}"> 
   <label for="name" class="text-2xl text-tiruhakim">full name</label>
   <input type="text" value="{{$doctor->name}}" name="name" placeholder="full name" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   @if($errors->has('name'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$error->first('name')}}</p>
   @endif
   <label for="email" class="text-2xl text-tiruhakim">email</label>
   <input type="email" value="{{$doctor->email}}" name="name" placeholder="email" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   @if($errors->has('email'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$error->first('email')}}</p>
   @endif
   <label for="speciality" class="text-2xl text-tiruhakim m-1">speciality</label>
   <div class="flex">
     @foreach ($doctor->specialities as $speciality)
      <div class="m-2">
       <input type="checkbox" class="form-checkbox border-2 border-tiruhakim text-tiruhakim h-8 w-8">
       <span class="text-2xl text-tiruhakim ">{{$speciality->name}}</span>   
      </div> 
      @endforeach
   </div>
   <div>
     <img src="/storage/doctors/{{$doctor->avatar}}" class="w-48">
    <label for="picture" class="text-2xl text-tiruhakim m-1">profile photo</label>
    <input type="file" name="picture" required class="text-xl bg-tiruhakim text-white"/>
   </div>
   @if ($errors->has('picture'))
     <p class="text-xl text-red-700 bg-red-200 w-max p-1">{{$errors->first('picture')}}</p>
   @endif
   <p>
    <label for="hospital" class="text-2xl text-tiruhakim m-1">hospital you work</label>
    <input type="text" name="hospital" placeholder="hospital name" class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   </p>
   @if($errors->has('hospital'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('hospital')}}</p>
   @endif
   <label class="text-2xl text-tiruhakim m-1">experience</label>
   <select name="experience" required>
    @foreach(range(1,30) as $experience)
     <option value="{{$experience}}">{{$experience}}</option>
    @endforeach
   </select>
   @if($errors->has('experience'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('experience')}}</p>
   @endif
   <p>
   <label class="text-2xl text-tiruhakim">description<span class="text-gray-500">(write something about you)<span></label>
   <input type="text" name="city" placeholder="about you" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   </p>
   @if($errors->has('description'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('description')}}</p>
   @endif
   <label class="text-2xl text-tiruhakim tiruhakim">phone number</label>
   <input type="text" name="phone" value="{{$doctor->phone_number}}" placeholder="phone number" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   @if($errors->has('phone'))
    <p class="text-red-600 text-xl bg-red-100 w-max p-1">{{$errors->first('phone')}}</p>
   @endif
   <div>
    <label for="sex" class="text-tiruhakim text-2xl mx-2">sex</label>
    <span class="text-2xl text-tiruhakim mx-2"><input type="radio" name="sex" value="male" class="form-radio text-tiruhakim h-8 w-8 border-2 border-tiruhakim">male</span>
    <span class="text-2xl text-tiruhakim mx-2"><input type="radio" name="sex" value="female" class="form-radio text-tiruhakim h-8 w-8 border-2 border-tiruhakim">female</span>
  </div> 
    <label for="age" class="text-tiruhakim text-2xl">age</label>
   <input type="number" value="{{$doctor->age}}" max="60" min="25" placeholder="age" class="text-xl p-2 w-20 border-2 border-gray-200">
   <input type="submit" value="edit profile" class="my-3 mx-6 py-2 px-3 rounded-3xl text-xl bg-tiruhakim text-white p-1">
  </form>
 </div>
@endsection
