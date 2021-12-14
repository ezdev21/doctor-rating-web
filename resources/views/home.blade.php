@extends('layouts.app')
@section('content')
<div class="container">
 <div class="flex m-2">
   <h1 class="text-tiruhakim text-3xl md:text-3xl lg:text-7xl xl:text-7xl 2xl:text-7xl m-auto order-2 lg:order-1 xl:order-1 2xl:order-1">find the right facilities and doctors to go to with confidence</h1>  
   <img class="w-full lg:w-1/2 xl:w-1/2 2xl:w-1/2 order-1 lg:order-2 xl:order-2 2xl:order-2" src="/storage/icons/doctors.svg">
 </div>
 <div class="my-5">
    <h2 class="text:xl md:text-2xl lg:text-3xl xl:text-3xl 2xl:text-4xl text-center m-2 mb-3 uppercase">find the care you need.</h2>
    <div class="mx-auto w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4 rounded-3xl shadow-xl">
      <form action="" class="flex">
       @csrf
       <input type="text" class="w-full p-3 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim" placeholder="search doctors">
       <input type="submit" class="text-white bg-tiruhakim rounded-3xl text-2xl py-2 px-10 my-auto" value="search"/>   
      </form>
    </div> 
 </div>
 <div class="flex my-5 mx-auto w-3/4 justify-around">
    <div class="w-36">
      <p class="text-5xl font-bold text-center">{{$totaldoctors}}</p>
      <p class="text-lg text-center">qualified doctors and medical specialities</p>
    </div>
    <div class="w-36">
        <p class="text-5xl font-bold text-tiruhakim text-center">{{$totalreviews}}</p>
        <p class="text-lg text-center">Ratings and reviews by Patients</p>
    </div>
    <div class="w-36">
        <p class="text-5xl font-bold text-center">{{$totalusers}}</p>
        <p class="text-lg text-center">People Helped through TiruHakim</p>
    </div>
 </div>
</div>
@endsection