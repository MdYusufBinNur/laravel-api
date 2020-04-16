<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hey {{ $assignedUser->name }},</h1>
                        <p>You’ve been assigned to a service request by <strong>{{$assignByUser->name }} </strong>. You can check the service request by clicking on the link bellow</p>
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
                                                            <td align="left" class="contribution-table-label" style="border-collapse: collapse;  font-size: 14px; padding: 7px 0 0; width: 190px">Requesting service for:</td>
                                                            <td align="left" class="contribution-table-value" style="border-collapse: collapse; font-size: 14px; font-weight: bold;  padding: 7px 0 0; white-space: pre">{{ $category->title }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="contribution-table-label" style="border-collapse: collapse;  font-size: 14px; padding: 7px 0 0; width: 190px">Service Created By :</td>
                                                            <td align="left" class="contribution-table-value" style="border-collapse: collapse; font-size: 14px; font-weight: bold; padding: 7px 0 0; white-space: pre">{{ $serviceRequestCreatedUser->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="contribution-table-label" style="border-collapse: collapse;  font-size: 14px; padding: 7px 0 0; width: 190px">Unit :</td>
                                                            <td align="left" class="contribution-table-value" style="border-collapse: collapse; font-size: 14px; font-weight: bold; padding: 7px 0 0; white-space: pre">{{ $unit->title }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" class="contribution-table-label" style="border-collapse: collapse;  font-size: 14px; padding: 7px 0 0; width: 190px">Estimated Delivery:</td>
                                                            <td align="left" class="contribution-table-value" style="border-collapse: collapse; font-size: 14px; font-weight: bold; padding: 7px 0 0; white-space: pre">{{ $serviceRequest->preferredEndTime }}</td>
                                                        </tr>

                                                        <tr>
                                                            <td align="left" class="contribution-table-label" style="border-collapse: collapse;  font-size: 14px; padding: 7px 0 0; width: 190px">Problem Description :</td>
                                                            <td>
                                                                <table width="300" cellpadding="0" cellspacing="0" role="presentation">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="justify" style="font-size: 14px; font-weight: bold; padding: 7px 0 0">
                                                                            {{ $serviceRequest->description }}
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
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
                                                                            <a href="{{$serviceRequestItemPage}}" class="f-fallback button button--brand" target="_blank">Request Details</a>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
{{--                                                    <hr style="align: left; border-top-color: #DDDDDD; border-top-style: solid; border-width: 1px 0 0; color: #eeeeee; display: block; height: 1px; margin: 20px 0 10px; padding: 0">--}}
{{--                                                    <div style="color: #6a6a6a; font-size: 12px; text-align: left" align="left">--}}
{{--                                                        <div>Questions about request ? Contact the request creator,--}}
{{--                                                            <a href="https://www.indiegogo.com/individuals/14187804/a2b0?utm_campaign=contribution_receipt&amp;utm_content=receipt-campaign_owner&amp;utm_medium=email&amp;utm_source=lifecycle" style="color: #004d46; text-decoration: none">Abdullah</a>.--}}
{{--                                                        </div>--}}
{{--                                                        <div style="margin-top: 10px">If you have any questions about this service Request, simply reply to this email or reach out to our  team for help.--}}
{{--                                                            <a href="https://www.indiegogo.com/contact/questions?i=a2b0&amp;utm_campaign=contribution_receipt&amp;utm_content=receipt-contact&amp;utm_medium=email&amp;utm_source=lifecycle" style="color: #004d46; text-decoration: none">Customer helpline</a>--}}
{{--                                                            team.--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
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
