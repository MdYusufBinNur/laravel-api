@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('announcement.created.body', ['announcement' => $announcement, 'property' => $property, 'user' => $user])
@endsection
