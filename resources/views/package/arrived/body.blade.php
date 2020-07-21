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
                            A package has Arrived at our reception desk for you.
                            Please find the details of the Package below.
                        </p>
                    </div>
                </td>
            </tr>
            <tr style="color:#4E5C6E; font-size:14px; line-height:20px;">
                <td class="content-cell" colspan="2" valign="top" align="center" style="padding-top: 0px; padding-bottom: 0px;" >
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>

                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-bottom: 25px;"> Package details</div>
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
                                    <tr>
                                        <td width="40%" style="padding-bottom: 10px; padding-top: 10px;">
                                         <strong> Arrived At</strong>
                                        </td>
                                        <td width=60%" style="padding-bottom: 10px; padding-top: 10px;">{{ $package->created_at->toDayDateTimeString() }} </td>
                                    </tr>
                                    @isset($package->trackingNumber)
                                    <tr>
                                        <td  width="40%" style="padding-bottom: 10px; padding-top: 10px;">
                                           <strong> Tracking Number </strong>
                                        </td>
                                        <td  width="60%" style="padding-bottom: 10px; padding-top: 10px;">{{$package->trackingNumber}}</td>
                                    </tr>
                                    @endisset
                                    @isset($package->description)
                                    <tr>
                                        <td  width="40%" style="padding-bottom: 10px; padding-top: 10px;">
                                            <strong>Description</strong>
                                        </td>
                                        <td  width="60%" style="padding-bottom: 10px; padding-top: 10px;">{{$package->description}}</td>
                                    </tr>
                                    @endisset
                                    @isset($package->comment)
                                    <tr>
                                        <td width="40%" style="padding-bottom: 10px; padding-top: 10px;">
                                           <strong>Comments</strong>
                                        </td>
                                        <td width="60%" style="padding-bottom: 10px; padding-top: 10px;"> {{$package->comment}}</td>
                                    </tr>
                                    @endisset
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="24" &nbsp;=""></td>
                        </tr>
                        <tr>
                            <td height="1" bgcolor="#DAE1E9"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="content-cell" >
                    <div class="f-fallback">
                        <p>
                            Sincerely
                            <br>
                            {{ $property->title }} Support Team
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
