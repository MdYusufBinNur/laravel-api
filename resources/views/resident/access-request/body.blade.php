<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> Hey {{ $residentAccessRequest->name }}</h1>
                        <p>
                            Our support team received your request for registration in our community.
                            Soon, You`ll notified by an email with a PIN.
                            You can continue further registration process in our community, by entering PIN.
                        </p>
                        <p>
                            If you don’t get any email within a few days, please contact with support team of your community.
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
