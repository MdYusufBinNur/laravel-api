@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Created Enterprise User'])
@endsection

@section('content')
    @include('equipment.expiration.body', ['enterpriseUser' => $enterpriseUser,'user' => $user,'company' => $company])
@endsection
