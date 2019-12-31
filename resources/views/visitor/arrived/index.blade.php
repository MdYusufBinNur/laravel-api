@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('visitor.arrived.body', ['visitor' => $visitor])
@endsection
