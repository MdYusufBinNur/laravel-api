@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('service-request.created.body', ['serviceRequest' => $serviceRequest, 'user' => $user, 'unit' => $this->unit, 'category' => $category, 'property' => $property])
@endsection
