@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', ['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit])
@endsection

@section('content')
    @include('resident.generate-pin.body', ['data' => 'Welcome to '.$property->title])
@endsection
