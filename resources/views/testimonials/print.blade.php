@extends('layouts.app')

@section('content')

  <ul>
    <li>Surname : {{$student->surname}}</li>
    <li>Othernames : {{$student->othernames}}</li>
    <li>Areas good at : {{$student->areas_good_at}}</li>
    <li>Image : <img src="{{asset('../storage/app/public/passports/'.$student->image)}}"></li>
    <li>Session admitted : {{$student->session_admitted}}</li>
    <li>Session graduated : {{$student->session_graduated}}</li>
    <li>Post held : {{$student->post_held}}</li>
    <li>Abilities : {{$student->abilities}}</li>
    <li>Conduct : {{$student->conduct}}</li>
  </ul>

@endsection
