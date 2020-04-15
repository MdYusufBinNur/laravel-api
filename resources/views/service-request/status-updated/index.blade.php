@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('service-request.status-updated.body', ['serviceRequest' => $serviceRequest, 'user' => $user, 'statusUpdatedByUser' => $statusUpdatedByUser,  'property' => $property])
@endsection
