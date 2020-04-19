<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">

                        <h1>Hi {{ $user->name }},</h1>
                        <p>Thanks for using SmartProperty. This is invoice is generated for using our service .</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tbody>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Amount Due:</strong>  {{$payment->amount}}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Due Date:</strong> {{$payment->dueDate->toDayDateTimeString()}}
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Action -->
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
                                                <a href="{{$paymentDetailsPage}}" class="f-fallback button button--brand" target="_blank">Pay Invoice</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="purchase" width="100%" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td>
                                    <h3>#{{$payment->id}}</h3>
                                </td>
                                <td>
                                    <h3 class="align-right">{{$reminder->created_at->toDayDateTimeString()}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">

{{--                                    {{#each invoice_details}}--}}

{{--                                    {{/each}}--}}
                                    Details
                                    <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <th class="purchase_heading" align="left">
                                                <p class="f-fallback">Description</p>
                                            </th>
                                            <th class="purchase_heading" align="right">
                                                <p class="f-fallback">Amount</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td width="70%" class="purchase_item"><span class="f-fallback">{{ $paymentType->title }}</span></td>
                                            <td class="align-right" width="30%"><span class="f-fallback">{{ $payment->amount }}</span></td>
                                        </tr>
                                        <tr>
                                            <td width="70%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total purchase_total--label">Total</p>
                                            </td>
                                            <td width="30%" class="purchase_footer" valign="middle">
                                                <p class="f-fallback purchase_total">{{$payment->amount}}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="{{'support_url'}}">support team</a> for help.</p>
                        <p>Cheers,
                            <br>The SmartProperty Team</p>
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation">
                            <tbody>
                            <tr>
                                <td>
                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                    <p class="f-fallback sub">{{$paymentDetailsPage}}</p>
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
