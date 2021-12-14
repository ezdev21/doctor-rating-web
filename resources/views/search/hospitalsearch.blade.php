@extends('layouts.app')
@section('content')
<div class="m-4 p-1">   
 <h1 class="text-3xl text-tiruhakim text-center my-2">{{$hospitals->count()}} hospitals found</h1>   
 @forelse($hospitals as $hospital)
 <div class="flex m-1 p-1">
  <img src="/storage/doctors/{{$hospital->picture}}" class="w-32 h-32 rounded-2xl m-1">
  <div class="">
   <p class="text-2xl">{{$hospital->name}}</p>
   <hospitalstars-component rate="{{$hospital->rate}}"/>
  </div>
  <div class="mx-2 my-auto">
    <button class="bg-tiruhakim text-xl py-2 px-3 text-white rounded-xl mx-2">
     <a href="/hospital/profile/{{$hospital->id}}" class="hover:text-white">view profile</a>  
    </button>
  </div>  
</div>
 @empty
 <div class="my-5 py-5">
   <p class="text-center text-6xl text-tiruhakim my-5">sorry! no hospital found like "<span class="text-red-600">{{$search_query}}</span>"</p>
 </div>
 @endforelse
</div>  
@endsection