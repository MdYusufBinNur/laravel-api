@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('manager.body', ['staff' => $staff,'user' => $user, 'property' => $property])
@endsection
