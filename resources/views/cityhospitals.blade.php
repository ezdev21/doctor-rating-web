@extends('layouts.app')
@section('content')
<div>
  <div class="p-5 bg-tiruhakim">
    <p class="text-3xl text-center text-white font-semibold">{{$hospitals->count()}} Hospitals found in <span class="capitalize">{{$city->name}}</span></p> 
  </div>
  <div class="my-3">
   @foreach ($hospitals as $hospital)
    <div class="flex border-b-1 border-gray-400">
      <img src="/storage/hospitals/{{$hospital->picture}}" class="w-36 my-auto mx-2">
      <div>
        <p class="text-xl capitalize">{{$hospital->name}}</p>
        <hospitalstars-component hospital-id="{{$hospital->id}}">  
      </div>
      <div class="mx-3">
        <p class="text-xl capitalize">{{$hospital->location}}</p>
      </div>
      <div class="my-auto">
        <button class="text-white bg-tiruhakim text-xl rounded-xl py-2 px-4">
          <a href="/hospital/profile/{{$hospital->id}}" class="hover:text-white">view profile</a>
        </button>  
      </div>
    </div>   
   @endforeach  
  </div>
</div>  
@endsection