<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Welcome, {{ $resident->user->name }}</h1>
                        <p>Thanks for trying SmartProperty. We’re thrilled to have you on board. To get the most out of SmartProperty, do this primary next step:</p>
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
                                                <a href="{{ 'https://'.$propertyLink }}" class="f-fallback button button--brand" target="_blank">Do this Next</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody></table>
                        <p>For reference, here's your login information:</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="attributes_content">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tbody>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Login Page:</strong> {{ 'https://'.$propertyLink }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item">
                                                <span class="f-fallback">
                                                  <strong>Username:</strong>
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <p>If you have any questions, feel free to
                            <a href="#">
                                email our customer success team
                            </a>.
                            (We're lightning quick at replying.) during business hours.
                        </p>
                        <p>
                            Thanks,
                            <br>
                            SmartProperty Team
                        </p>
                        <p><strong>P.S.</strong> Need immediate help getting started? Check out our
                            <a href="#">help documentation</a>.
                            Or, just reply to this email, the [Product Name] support team is always ready to help!
                        </p>
                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation">
                            <tbody>
                            <tr>
                                <td>
                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                    <p class="f-fallback sub">{{ 'https://'.$propertyLink }}</p>
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
