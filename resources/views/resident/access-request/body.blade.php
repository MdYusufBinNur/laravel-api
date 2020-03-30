<table bgcolor="#0292B7" cellpadding="0" cellspacing="0"
       class="force-full-width" style="margin: 0 auto;">
    <tbody >
    @if($toStaff)
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color:#ffffff;"><br>
                        To
                        <br>
                        {{ $property->title }} Authority
                        <br>
                        <br>
                        {{ $residentAccessRequest->name }} has sent a registration request to your property.
                        <br>
                        <br>
                        <br>
                        Please review his/her request from your property.

                        <br>
                        <br>
                        <br>
                        Thank You
                        <br>
                        Smart Property Team
                        <br>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    @else
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color:#ffffff;"><br>
                        Hey {{ $residentAccessRequest->name }}
                        <br>
                        <br>
                        Our support team received your request for registration in our community.
                        Soon, You`ll notified by an email with a PIN.
                        You can continue further registration process in our community, by entering PIN.
                        <br>
                        <br>
                        <br>
                        If you don’t get any email within a few days, please contact with support team of your community.
                        <br>
                        <br>
                        <br>
                        Thank You
                        <br>
                        {{ $property->title }} Support Team
                        <br>
                        <br>
                        {{ $property->address }}
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    @endif
    <tr >
        <td >

            <br>
            <br>
            <br>
            <br>
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
