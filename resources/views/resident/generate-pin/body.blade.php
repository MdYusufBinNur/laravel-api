<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hey {{ $residentAccessRequest->name }}</h1>
                        <p>
                           Your Pin is: {{$residentAccessRequest->pin}}
                        </p>
                        <br>
                        <p>
                            Thank You
                            <br>
                            {{ $property->title }} Support Team
                            <br>
                            {{ $property->address }}
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>

