@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Equipment Expiration'])
@endsection

@section('content')
    @include('equipment.expiration.body', ['equipment' => $equipment,'property' => $property])
@endsection
