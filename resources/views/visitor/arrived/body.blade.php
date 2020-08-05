<!-- Email Body start-->
<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content Start -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> {{ ($visitor->unit && $visitor->unit->title) ? ('Dear ' .$unit->title) : ('Dear Mr/Mrs. ' . $visitor->user->name) }},</h1>
                        <p style="margin-bottom: 0px;">
                           You`ve got a visitor, Check about the visitors details in the below
                        </p>
                    </div>
                </td>
            </tr>

            <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px;">
                <td class="content-cell" colspan="2" valign="top" align="center">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>
                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-bottom: 25px;"> Visitor Info</div>
                            </td>
                        </tr>
                        <tr>
                            <td height="1" bgcolor="#DAE1E9"></td>
                        </tr>
                        <tr>
                            <td height="24" &nbsp;=""></td>
                        </tr>
                        <!-- Image part Start -->
                        <tr>
                            @isset($visitor->image)
                                <td align="center">
                                    <img src="{{$visitor->image->getFileUrl()}}" width="200" style="height: auto;">
                                </td>
                            @endisset
                        </tr>
                        <!-- Image part End -->
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%; border-collapse:collapse;">
                                    <tbody style="border: 0; padding: 0; margin-top:20px;">
                                        @isset($visitor->name)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Name</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->name}}
                                                </td>
                                            </tr>
                                        @endisset
                                        <tr>
                                            <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                <strong> Arrived at</strong>
                                            </td>
                                            <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                {{$visitor->signInAt->toDayDateTimeString()}}
                                            </td>
                                        </tr>

                                        @isset($visitor->email)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Email</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->email}}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($visitor->phone)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Phone</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->phone}}
                                                </td>
                                            </tr>
                                        @endisset
                                        @isset($visitor->company)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Company</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->company}}
                                                </td>
                                            </tr>
                                        @endisset
                                        @isset($visitor->comment)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Comment</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->comment}}
                                                </td>
                                            </tr>
                                        @endisset
                                        @isset($visitor->status)
                                            <tr>
                                                <td width="40%" style="padding-bottom: 15px; padding-top: 10px; vertical-align: baseline;">
                                                    <strong> Status</strong>
                                                </td>
                                                <td width=60%" style="padding-bottom: 15px; padding-top: 10px;">
                                                    {{$visitor->status}}
                                                </td>
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
                <td height="20"></td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<!-- Body content end -->
