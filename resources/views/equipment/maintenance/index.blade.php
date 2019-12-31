@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('equipment.maintenance.body', ['equipment' => $equipment,'property' => $property])
@endsection
