@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('resident.body', [ 'resident' => $resident, 'property' => $property , 'propertyLink' => $propertyLink])
@endsection
