<table bgcolor="#4DBFBF" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
    <tbody>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0"
                   style="margin: 0 auto;" width="80%">
                <tbody>
                <tr>
                    <td height="50">

                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:18px;color:#ffffff; text-align: left;">
                        Dear {{ $toUser->name }}, <br> <br>

                        You Have a new message from {{ $fromUser->name }}.<br>
                        <br>
                        <br>
                       {{ $messageText }}
                        <br>
                        <br>
                        <br>
                        <br>

                        Sincerely, <br>
                        {{ $fromUser->name }}
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
