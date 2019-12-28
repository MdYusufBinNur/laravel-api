@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Manager Created'])
@endsection

@section('content')
    @include('manager.body', ['staff' => $staff,'user' => $user])
@endsection
