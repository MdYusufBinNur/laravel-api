@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('resident.access-request.body', ['residentAccessRequest' => $residentAccessRequest, 'toStaff' => $toStaff, 'property' => $property, 'unit' => $unit])
@endsection
