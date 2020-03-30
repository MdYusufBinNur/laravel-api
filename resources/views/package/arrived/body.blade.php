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
                        Dear Mr. {{ $unit->title || $resident->user->name }}, <br> <br>

                        A package has Arrived at our reception desk for you.<br>
                        Please find the details of the Package below.
                        <br>
                        Arrived at: {{ $package->created_at }}
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
                        Please collect your package from our reception desk.<br>

                        <br>
                        <br>

                        Best regards, <br>
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
