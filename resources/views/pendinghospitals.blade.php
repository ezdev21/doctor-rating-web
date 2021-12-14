@extends("layouts.app")
@section("content")
 <div class="">
  @forelse($hospitals as $hospital)
   <div class="">
    <img src="/storage/pendinghospitals/{{$hospital->picture}}" class="w-10 h-10 ">
    <p class="">{{$hospital->name}}</p>
    <p class="">{{$hospital->age}}</p>
    <p class="">{{$dhospital->location}}</p>
   </div>
  @endforelse
 </div>
@endsection
