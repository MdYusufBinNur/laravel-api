@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('inventory.item-update.body', ['inventoryItemLog' => $inventoryItemLog, 'inventoryItem' => $inventoryItem, 'property' => $property])
@endsection
