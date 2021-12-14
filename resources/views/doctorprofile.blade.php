@extends('layouts.app')
@section('content')
 <div class="">
  <div>
   <doctorprofile-component doctor-id="{{$doctor->id}}" @auth user-id="{{auth()->user()->id}}" @endauth/>
  </div>
 </div>  
@endsection
