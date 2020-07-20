<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody><tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> Hey {{ $user->name }},</h1>
                        <p>You recently requested to reset your password for your SmartProperty account. Use the button below to reset it. <strong>This password reset is only valid for the next 24 hours.</strong></p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody><tr>
                                <td align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                        <tbody><tr>
                                            <td align="center">
                                                <a  href="{{ $resetLink }}" class="f-fallback button button--brand" target="_blank">
                                                    <span style="color: white">Reset your password</span>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            </tbody></table>
                        <p>For security, this request was received earlier. If you did not request a password reset, please ignore this email or <a href="https://smartproperty.xyz">contact support</a> if you have questions.</p>
                        <p>
                            Thanks,
                            <br>The SmartProperty Team
                        </p>
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation">
                            <tbody>
                            <tr>
                                <td>
                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                    <a href="{{ $resetLink }}" class="f-fallback" target="_blank">
                                        <span style="color: blue">{{ $resetLink }}</span>
                                    </a>
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
