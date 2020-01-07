<table bgcolor="#0292B7" cellpadding="0" cellspacing="0"
       class="force-full-width" style="margin: 0 auto;">
    <tbody >
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color:#ffffff;"><br>
                        Hey {{ $user->name }}
                        <br>
                        <br>
                        Reminder!
                        <br>
                        <br>
                        You have to pay your due payment before {{$payment->dueDate}}.
                        In the below we added your payment details. please check it.
                        <br>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0"
                   style="margin: 0 auto;" width="60%">
                <tbody>
                <tr>
                    <td style="font-size:18px;color:#ffffff;">
                        <br>
                        Reminder Details: <br>
                        <hr>
                        Amount: {{$payment->amount}} <br>
                        Note: {{$payment->note}} <br>
                        Due Date: {{$payment->dueDate}} <br>
                        Due Days: {{$payment->dueDays}} <br>
                        Status: {{$payment->status}} <br>
                        <hr>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color:#ffffff;"><br>
                        <br>
                        Regards
                        <br>
                        {{ $property->title }} Support Team
                        <br>
                        <br>
                        {{ $property->address }}
                        <br>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<table bgcolor="#F5774E" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
    <tbody>
    <tr>
        <td style="background-color:#f5774e;">
            <center>

            </center>
        </td>
    </tr>
    </tbody>
</table>
