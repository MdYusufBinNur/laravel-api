@extends('layouts.app')
@section('logo')
    @include('layouts.logo')
@endsection
@section('content')
    @include('message.notification.body', ['messageModel' => $messageModel,'fromUser' => $fromUser,'toUser' => $toUser,'messageText' => $messageText,'property' => $property])
@endsection
