<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">

                        <h1>Greetings {{ $contactName }},</h1>
                        <p>Thanks for using SmartProperty.</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tbody>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Amount Paid</strong>  {{$payment->amount}}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Type </strong>  {{$payment->paymentType->title}}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Method </strong>  {{$payment->method}}
                                                </span>
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
                                    <h3>#{{$paymentItem->id}}</h3>
                                </td>
                                <td>
                                    <h3 class="align-right">{{$paymentItem->created_at->toDayDateTimeString()}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                    {{--                                    {{#each invoice_details}}--}}

                                    {{--                                    {{/each}}--}}
                                    Pyament Details
                                    <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <th class="purchase_heading" align="left">
                                                <p class="f-fallback">Description</p>
                                            </th>
                                            <th class="purchase_heading" align="right">
                                            </th>
                                        </tr>
                                        @isset($payment->note)
                                            <tr>
                                                <td width="30%" class="purchase_item"><span class="f-fallback"> Note </span></td>
                                                <td class="align-right" width="70%"><span class="f-fallback">{{ $payment->note }}</span></td>
                                            </tr>
                                        @endisset
                                        @isset($payment->billingInfo)
                                            <tr>
                                                <td width="30%" class="purchase_item"><span class="f-fallback"> BillingInfo </span></td>
                                                <td class="align-right" width="70%"><span class="f-fallback">{{ $payment->billingInfo }}</span></td>
                                            </tr>
                                        @endisset
                                        <tr>
                                            <td width="30%" class="purchase_item"><span class="f-fallback"> Due Date </span></td>
                                            <td class="align-right" width="70%"><span class="f-fallback">{{ $payment->dueDate->toDayDateTimeString() }}</span></td>
                                        </tr>
                                        <tr>
                                            <td width="30%" class="purchase_item"><span class="f-fallback"> Status </span></td>
                                            <td class="align-right" width="70%"><span class="f-fallback">{{ $paymentItem->status }}</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p>If you have any questions about this invoice, simply reply to this email or reach out to our <a href="{{'support_url'}}">support team</a> for help.</p>
                        <p>Sincerely,<br>The SmartProperty Team</p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>


