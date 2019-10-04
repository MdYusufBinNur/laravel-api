{{--todo--}}

<br>
New message arrived: <br>
<hr>
Arrived At: {{$messageModel->created_at->toDayDateTimeString()}} <br>
From User : {{$fromUser->name}} <br>
Text: {{$messageText}} <br>

<hr>
