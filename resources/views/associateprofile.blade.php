@extends('layouts.app')
@section('content')
<div>
  <associateprofile-component @isset($doctor) doctor-id="{{$doctor->id}}" @endisset @auth user-id="{{auth()->user()->id}}" @endauth/>  
</div>   
@endsection