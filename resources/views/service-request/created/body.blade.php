<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Thank You!</h1>
                        <p>Thanks for creating the service request! You'll soon find out about your service request status.</p>
                        <!-- Action -->
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border-collapse: collapse; margin-top: 10px" class="">
                            <tbody>
                            <tr>
                                <td align="left" style="border-collapse: collapse">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse">
                                        <tbody>
                                        <tr style="margin: 0; padding: 0">
                                            <td align="center" style="border-collapse: collapse; border-spacing: 0; ">
                                                <div>
                                                    <h1 style="text-align: left;" align="left">Service Request Details</h1>
                                                    <hr style="align: left; border-top-color: #DDDDDD; border-top-style: solid; border-width: 1px 0 0; display: block; height: 1px; margin: 10px 0 20px; padding: 0">
                                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; position: relative">
                                                        <tbody>
                                                        <tr>
                                                            <td class="attributes_item" style="padding-bottom: 15px;">
                                                                <strong style="padding-right: 5px;">Requesting service for:</strong>
                                                                <span class="label">{{ $category->title }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="attributes_item" style="padding-bottom: 15px;">
                                                                <strong style="padding-right: 5px;">Service Created By :</strong>
                                                                <span class="label">{{ $user->name }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="attributes_item" style="padding-bottom: 15px;">
                                                                <strong style="padding-right: 5px;">Unit :</strong>
                                                                <span class="label">{{  $unit->title }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="attributes_item" style="padding-bottom: 15px;">
                                                                <strong style="padding-right: 5px;">Estimated Delivery:</strong>
                                                                <span class="label">{{  $serviceRequest->preferredEndTime  }}</span>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <h1 style="margin-top: 5px; margin-bottom: 5px;">Problem Description:</h1>
                                                                <hr style="align: left; border-top-color: #DDDDDD; border-top-style: solid; border-width: 1px 0 0; display: block; height: 1px; margin: 0px 0 10px; padding: 0">
                                                                <p style="margin-bottom: 0px;">{{ $serviceRequest->description }}</p>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <!-- Border based button
                                                                https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="center">
                                                                            <a href="{{$serviceRequestItemPage}}" class="f-fallback button button--brand" target="_blank">
                                                                                <span style="color: white">Request Details</span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr style="align: left; border-top-color: #DDDDDD; border-top-style: solid; border-width: 1px 0 0; color: #eeeeee; display: block; height: 1px; margin: 20px 0 10px; padding: 0">
                                                    <div style="color: #6a6a6a; font-size: 12px; text-align: left" align="left">
                                                        <div>Questions about request ? Contact the request creator,
                                                            <a href="https://www.indiegogo.com/individuals/14187804/a2b0?utm_campaign=contribution_receipt&amp;utm_content=receipt-campaign_owner&amp;utm_medium=email&amp;utm_source=lifecycle" style="color: #004d46; text-decoration: none">Abdullah</a>.
                                                        </div>
                                                        <div style="margin-top: 10px">If you have any questions about this service Request, simply reply to this email or reach out to our  team for help.
                                                            <a href="https://www.indiegogo.com/contact/questions?i=a2b0&amp;utm_campaign=contribution_receipt&amp;utm_content=receipt-contact&amp;utm_medium=email&amp;utm_source=lifecycle" style="color: #004d46; text-decoration: none">Customer helpline</a>
                                                            team.
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
