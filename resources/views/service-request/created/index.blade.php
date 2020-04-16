@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('service-request.created.body', ['serviceRequestItemPage' => $serviceRequestItemPage, 'serviceRequest' => $serviceRequest, 'user' => $user, 'unit' => $unit, 'category' => $category, 'property' => $property])
@endsection
