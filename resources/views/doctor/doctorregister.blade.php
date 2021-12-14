@extends('layouts.app')
@section('content')
 <div>
  <doctorregister-component all-specialities="{{$specialities}}" all-languages="{{$languages}}" all-hospitals="{{$hospitals}}"/>
 </div>
@endsection