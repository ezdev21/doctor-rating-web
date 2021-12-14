@extends('layouts.app')
@section('content')
<div class="">
 <div class="flex mt-2 flex-wrap items-center">
   <div class="md:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 order-2 md:order-1 lg:order-1 xl:order-1 2xl:order-1">
    <h1 class="p-3 pl-px my-auto  font-bold capitalize text-tiruhakim text-4xl md:text-5xl lg:text-6xl xl:text-6xl 2xl:text-6xl font-sans" style="line-height:1.15;">find the right facilities and doctors to go to with confidence</h1>  
   </div>
   <div class="md:w-1/2 lg:w-1/2 xl:w-1/2 2xl:w-1/2 order-1 lg:order-2 xl:order-2 2xl:order-2 p-1">
    <img src="/storage/icons/undraw_medicine_b1ol.svg">
   </div> 
  </div>
 <div class="my-3">
    <h2 class="font-semibold text-gray-600 italic text-3xl md:text-3xl lg:text-3xl xl:text-3xl 2xl:text-4xl text-center m-1 mb-3 capitalize">find the care you need.</h2>
    <div class="hidden">
      <form method="POST" action="{{route('search')}}" id="search-form">
        @csrf
       <input type="text" name="searchQuery" id="searchQuery">
       <input type="submit" value="submit">
      </form>
    </div>
    <homesearch-component />
 </div>
 <div class="flex flex-wrap my-5 py-5 mx-auto w-full lg:w-3/4 xl:w-3/4 2xl:w-3/4 justify-around">
    <div class="w-48">
      <p class="text-6xl font-bold text-center">{{$totaldoctors}}</p>
      <p class="text-lg lg:text-xl xl:text-xl 2xl:text-xl text-center mt-3">qualified doctors and medical specialities</p>
    </div>
    <div class="w-48">
        <p class="text-6xl font-bold text-tiruhakim text-center">{{$totalreviews}}</p>
        <p class="text-lg lg:text-xl xl:text-xl 2xl:text-xl text-center mt-3">Ratings and reviews by Patients</p>
    </div>
    <div class="w-48">
        <p class="text-6xl font-bold text-center">{{$totalusers}}</p>
        <p class="text-lg lg:text-xl xl:text-xl 2xl:text-xl text-center mt-3">People Helped through TiruHakim</p>
    </div>
 </div>
</div>
@endsection