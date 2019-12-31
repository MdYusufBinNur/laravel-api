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
                        Dear {{ $resident->user->name }}, <br> <br>

                        Thank You for receiving your package.<br>
                        <br>
                        <br>

                        Package details:
                        <br>
                        <br>
                        Tracking Number: {{$package->trackingNumber}}
                        <br>
                        Description: {{$package->description}}
                        <br>
                        Comments: {{$package->comment}}
                        <br>
                        <br>
                        <br>
                        If you have any objection about this package please contact with our support team <br>

                        <br>
                        <br>

                        Regards, <br>
                        Team {{ $property->title }}

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
