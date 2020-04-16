@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('content')
    @include('service-request.assign-to-staff.body', ['serviceRequestItemPage' => $serviceRequestItemPage, 'serviceRequest' => $serviceRequest,  'serviceRequestCreatedUser' => $serviceRequestCreatedUser,  'assignedUser' => $assignedUser, 'assignByUser' => $assignByUser, 'unit' => $unit, 'category' => $category,  'property' => $property])
@endsection
