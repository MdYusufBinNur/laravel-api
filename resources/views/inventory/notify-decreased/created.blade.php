@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'Inventory Item Decreased'])
@endsection

@section('content')
    @include('inventory.notify-decreased.body', ['inventory' => $inventory,'property' => $property])
@endsection
