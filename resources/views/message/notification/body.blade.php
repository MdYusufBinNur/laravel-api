<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody><tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hi {{ $toUser->name }}, </h1>
                        <p>You have a new message</p>
                        <p>By {{ $fromUser->name }} at {{$messageModel->created_at->toDayDateTimeString()}}</p>
                        <p> {{ $messageText }}</p>
{{--                        <p class="sub"><a href="{{action_url}}">View the Full Massage</a></p>--}}
                    </div>
                </td>
            </tr>
            </tbody></table>
    </td>
</tr>
