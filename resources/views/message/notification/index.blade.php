@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection

@section('title')
    @include('layouts.title', [ 'data' => 'A new message from'. $fromUser->name])
@endsection

@section('content')
    @include('message.notification.body', ['messageModel' => $messageModel,'fromUser' => $fromUser,'messageText' => $messageText])
@endsection
