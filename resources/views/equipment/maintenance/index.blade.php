@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Inventory Item Decreased'])
@endsection

@section('content')
    @include('equipment.maintenance.body', ['equipment' => $equipment,'property' => $property])
@endsection
