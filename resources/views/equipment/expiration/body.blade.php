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
                        {{ $property->title }} Authority, <br> <br>

                        <br>
                        Maintenance Reminder: <br>
                        <hr>
                        Property: {{$property->title}} <br>
                        Next maintenance day: {{$equipment->nextMaintenanceDate->toDayDateTimeString()}} <br>
                        ExpiredDate : {{$equipment->expireDate->toDayDateTimeString()}} <br>
                        Name: {{$equipment->name}} <br>
                        Description: {{$equipment->description}} <br>
                        Model No.: {{$equipment->modelNumber}} <br>
                        Required Service: {{$equipment->requiredService}} <br>
                        <br>
                        <br>
                        <br>
                        If You Have any issue about this please contact with out smart property team. <br>
                        <br>
                        <br>

                        Thank You<br>
                        Team Smarty Property
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
