@extends('layouts.app')
@section('content')
<div class="flex">
  <button class="bg-tiruhakim text-xl text-white py-2 px-4 rounded-xl m-2">
    <a href="/doctor/profile/{{$doctor->id}}/edit">edit profile</a>
  </button>
  <div class="m-2">
    <addspeciality-component/>
  </div>
</div>
<div class="m-5">
  <doctorprofile-component doctor-id="{{$doctor->id}}" user-id="{{auth()->user()->id}}">
</div>
@endsection