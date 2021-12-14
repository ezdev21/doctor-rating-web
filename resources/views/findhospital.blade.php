@extends('layouts.app')
@section('content')
<div>
 <form method="POST" id="search-form" action="{{route('hospital.search')}}" class="hidden">
  @csrf
  <input type="text" name="searchQuery" id="searchQuery" class="p-3 w-2/3 text-xl outline-none" placeholder="search doctors">
  <input type="submit"  class="text-white bg-blue-700 rounded-3xl text-2xl py-2 px-10 my-auto" value="search"/>   
 </form>
 <div><findhospital-component></div>
</div>
@endsection