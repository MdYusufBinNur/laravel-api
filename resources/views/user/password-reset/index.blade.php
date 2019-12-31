@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('user.password-reset.body', ['resetLink' => $resetLink, 'user' => $user])
@endsection
