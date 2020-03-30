@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('module-property.body', ['moduleProperty' => $moduleProperty, 'module' => $module, 'property' => $property, 'user' => $user,])
@endsection
