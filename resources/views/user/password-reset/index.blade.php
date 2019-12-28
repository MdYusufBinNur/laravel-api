@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Password Reset'])
@endsection

@section('content')
    @include('user.password-reset.body', ['resetLink' => $resetLink])
@endsection
