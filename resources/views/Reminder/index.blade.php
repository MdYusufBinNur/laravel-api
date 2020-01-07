@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('reminder.body',['reminder' => $reminder, 'property' => $property, 'user' => $user, 'details' => $details])
@endsection
