@extends('layouts.app')
@section('content')
 <div>
  <h2 class="text-2xl mx-10">
  <div class="flex">
   <h2 class="">$hospital->motto</h2>
   <img src="/storage/hospitals/{{$hospital->picture}}" class="w-36">
  </div>
  <p class="">{{$hospital->description}}</p>
  <div>
  <rate-component />
  <evaluation-component>
  <div>
 </div>
@endsection
