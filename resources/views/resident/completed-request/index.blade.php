@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('resident.completed-request.body', ['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'unit' => $unit])
@endsection
