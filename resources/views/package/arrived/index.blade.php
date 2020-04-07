@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('package.arrived.body',['package' => $package, 'resident' => $resident, 'unit' => $unit, 'property' => $property])
@endsection
