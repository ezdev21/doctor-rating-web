@extends('layouts.app')
@section('content')
<div class="block lg:flex xl:flex 2xl:flex my-5">
 <div class="w-1/2 border-r-1 border-gray-300">  
 <h1 class="text-3xl text-center text-tiruhakim my-2">{{$doctors->count()}} doctors found</h1> 
 @forelse($doctors as $doctor)
 <a href="/doctor/profile/{{$doctor->id}}">
 <div class="hover:bg-blue-200 m-1 p-1">
  <div class="w-max mx-auto flex"> 
  <img src="/storage/doctors/{{$doctor->avatar}}" class="h-28 rounded-3xl m-1">
  <div class=" mx-1 my-auto">
   <p class="text-2xl capitalize">{{$doctor->name}}</p>
   <stars-component rate="{{$doctor->rate}}"/>
    <p class="text-xl">{{$doctor->hospital}}</p>
  </div>
  <div class="mx-2 my-auto">
   <button class="bg-tiruhakim text-xl py-2 px-3 text-white rounded-xl mx-2">
    <a href="/doctor/profile/{{$doctor->id}}" class="hover:text-white">view profile</a>  
   </button>
   </div>  
   </div>
  </div>
 </a>
 @empty
  <div class="my-5 py-5">
   <p class="text-center text-3xl text-tiruhakim my-5">oops no doctor found like "<span class="text-red-600">{{$search_query}}</span>"</p>
  </div> 
   @endforelse
 </div>
 <div class="w-1/2 border-l-2 border-gray-300"> 
  <h1 class="text-3xl text-tiruhakim text-center my-2">{{$hospitals->count()}} hospitals found</h1>   
  @forelse($hospitals as $hospital)
  <div class="hover:bg-blue-200 m-1 p-1">
   <div class="flex w-max mx-auto">
    <img src="/storage/doctors/{{$hospital->picture}}" class="h-28 rounded-3xl m-1">
    <div class="mx-1 my-auto">
    <p class="text-2xl capitalize">{{$hospital->name}}</p>
    <hospitalstars-component rate="{{$hospital->rate}}"/>
    </div>
    <div class="mx-2 my-auto">
      <button class="bg-tiruhakim text-xl py-2 px-3 text-white rounded-xl mx-2">
       <a href="/doctor/profile/{{$doctor->id}}" class="hover:text-white">view profile</a>  
      </button>
    </div>
  </div> 
  </div>
  @empty
  <div class="mx-auto my-5 py-5">
    <p class="text-center text-3xl text-tiruhakim my-5">oops no hospital found like "<span class="text-red-600">{{$search_query}}</span>"</p>
  </div> 
  @endforelse
</div>
</div>  
@endsection