<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> {{ ($unit && $unit->title) ? ('Dear ' .$unit->title) : ('Dear Mr/Mrs. ' . $resident->user->name) }},</h1>
                        <p>
                            Thank You for receiving your package.
                        </p>
                    </div>
                </td>
            </tr>
            <tr style="color:#4E5C6E; font-size:14px; line-height:20px;">
                <td class="content" colspan="2" valign="top" align="center" style="padding-left:90px; padding-right:90px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>

                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;"> Package details</div>
                            </td>
                        </tr>
                        <tr>
                            <td height="1" bgcolor="#DAE1E9"></td>
                        </tr>
                        <tr>
                            <td height="24" &nbsp;=""></td>
                        </tr>
                        <tr>
                            <td align="center">
                                <table style="width: 100%; border-collapse:collapse;">
                                    <tbody style="border: 0; padding: 0; margin-top:20px;">
                                    @isset($package->trackingNumber)
                                    <tr>
                                        <td style="padding-bottom: 10px; padding-top: 10px;"> Tracking Number </td>
                                        <td style="padding-bottom: 10px; padding-top: 10px;">{{$package->trackingNumber}}</td>
                                    </tr>
                                    @endisset
                                    @isset($package->description)
                                    <tr>
                                        <td style="padding-bottom: 10px; padding-top: 10px;">  Description</td>
                                        <td style="padding-bottom: 10px; padding-top: 10px;">{{$package->description}}</td>
                                    </tr>
                                    @endisset
                                    @isset($package->comment)
                                    <tr>
                                        <td style="padding-bottom: 10px; padding-top: 10px;"> Comments</td>
                                        <td style="padding-bottom: 10px; padding-top: 10px;"> {{$package->comment}}</td>
                                    </tr>
                                    @endisset
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="content-cell">
                    <p>
                        If you have any objection about this package please contact with our support team <br>
                    </p>
                    <div class="f-fallback">
                        <p>
                            Regards, <br>
                            Team {{ $property->title }}
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
