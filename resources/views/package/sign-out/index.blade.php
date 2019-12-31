@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('package.sign-out.body',['package' => $package, 'packageArchive' => $packageArchive, 'resident' => $resident, 'unit' => $unit, 'property' => $property])
@endsection
