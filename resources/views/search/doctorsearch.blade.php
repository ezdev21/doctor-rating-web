@extends('layouts.app')
@section('content')
<div class="m-4 p-1">  
  <h1 class="text-3xl text-tiruhakim text-center my-2">{{$doctors->count()}} doctors found</h1> 
 @forelse($doctors as $doctor)
 <div class="flex m-1 p-1">
  <img src="/storage/doctors/{{$doctor->avatar}}" class="h-28 rounded-2xl m-1">
  <div class="mx-1 my-auto">
   <p class="text-2xl">{{$doctor->name}}</p>
   <stars-component rate="{{$doctor->rate}}"/>
  </div>
  <div class="mx-2 my-auto">
    <button class="bg-tiruhakim text-xl py-2 px-3 text-white rounded-xl mx-2">
     <a href="/doctor/profile/{{$doctor->id}}" class="hover:text-white">view profile</a>  
    </button>
  </div>
</div>
 @empty
 <div class="my-5 py-5">
   <p class="text-center text-6xl text-tiruhakim my-5">sorry! no doctor found like "<span class="text-red-600">{{$search_query}}</span>"</p>
 </div>
 @endforelse
</div>  
@endsection