@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Thanks for receiving your package'])
@endsection

@section('content')
    @include('package.sign-out.body',['package' => $package, 'packageArchive' => $packageArchive])
@endsection
