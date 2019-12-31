@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('enterprise-user.body', ['enterpriseUser' => $enterpriseUser,'user' => $user,'company' => $company])
@endsection
