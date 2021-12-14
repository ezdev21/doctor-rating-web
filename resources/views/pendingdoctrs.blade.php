@extends("layouts.app")
@section("content")
 <div class="">
  @forelse($doctors as $doctor)
   <div class="">
    <img src="/storage/pendingdoctors/{{$doctor->avatar}}" class="w-10 h-10 ">
    <p class="">{{$doctor->name}}</p>
    <p class="">{{$doctor->speciality}}</p>
    <p class="">{{$doctor->age}}</p>
    <p class="">{{$doctor->location}}</p>
    <p class="">{{$doctor->gender}}</p>
    <p class="">{{$doctor->experience}}</p>
   </div>
  @endforelse
 </div>
@endsection
