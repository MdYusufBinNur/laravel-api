@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('fdi.body', ['staffUser' => $staffUser, 'fdi' => $fdi, 'property' => $property, 'unit' => $unit, 'fdiRequestLink' => $fdiRequestLink])
@endsection
