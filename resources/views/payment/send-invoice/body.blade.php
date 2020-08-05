<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">

                        <h1>Greetings {{ $contactName }},</h1>
                        <p>Thanks for using SmartProperty. This is an invoice for your using {{ $paymentType->title }}.</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tbody>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Amount Due: </strong>  BDT {{$payment->amount}}
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin-bottom: 0px;">
                            <tbody><tr>
                                <td align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                        <tbody><tr>
                                            <td align="center">
                                                <a href="{{'https://' . $paymentDetailsPage}}" class="f-fallback button button--brand" target="_blank">
                                                   <span style="color: white;">Pay Invoice</span>
                                                </a>
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
                                    <h3 class="align-right">{{$paymentItem->created_at->toFormattedDateString()}}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%" class="" style="padding-bottom: 15px; vertical-align: baseline"><span class="f-fallback" > <strong>Pay For</strong> </span></td>
                                <td class="align-left" width="70%" style="padding-bottom: 15px;"><span class="f-fallback" >{{  $paymentType->title }}</span></td>
                            </tr>
                            @isset($payment->note)
                                <tr>
                                    <td width="30%" class="" style="padding-bottom: 15px; vertical-align: baseline"><span class="f-fallback" >  <strong> Note </strong></span></td>
                                    <td class="align-left" width="70%" style="padding-bottom: 15px;"><span class="f-fallback" >{{ $payment->note }}</span></td>
                                </tr>
                            @endisset
                            @isset($payment->dueDate)
                                <tr>
                                    <td width="30%" class="" style="padding-bottom: 15px; vertical-align: baseline"><span class="f-fallback" ><Strong> Due Date </Strong></span></td>
                                    <td class="align-left" width="70%" style="padding-bottom: 15px;"><span class="f-fallback" >{{ $payment->dueDate->toFormattedDateString() }}</span></td>
                                </tr>
                             @endisset
                             @isset($payment->dueDays)
                                <tr>
                                    <td width="30%" class="" style="padding-bottom: 15px; vertical-align: baseline"><span class="f-fallback"><strong> Due Days</Strong> </span></td>
                                    <td class="align-left" width="70%" style="padding-bottom: 15px;"><span class="f-fallback" >{{ $payment->dueDays }}</span></td>
                                </tr>
                             @endisset
                            <tr>
                                <td colspan="2">
                                    <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <th class="purchase_heading" align="left">
                                                <p class="f-fallback">Description</p>
                                            </th>
                                            <th class="purchase_heading" align="right">
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
                        <p>Sincerely,<br>The SmartProperty Team</p>
                        <table class="body-sub" role="presentation">
                            <tbody><tr>
                                <td>
                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                    <p class="f-fallback sub">{{'https://' . $paymentDetailsPage}}</p>
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





