@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Hi, '.$resident->user->name. ' You successfully created your profile'])
@endsection

@section('content')
    @include('resident.body')
@endsection
