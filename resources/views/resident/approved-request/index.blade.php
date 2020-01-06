@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('resident.approved-request.body', ['residentAccessRequest' => $residentAccessRequest, 'property' => $property, 'completeRegistrationLink' => $completeRegistrationLink, 'unit' => $unit])
@endsection
