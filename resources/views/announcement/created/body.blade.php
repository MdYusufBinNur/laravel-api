<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> Dear Mr. {{ $user->name }},</h1>
                    </div>
                </td>
            </tr>
            <tr style="color:#4E5C6E; font-size:14px; line-height:20px;">
                <td class="content" colspan="2" valign="top" align="center" style="padding-left:50px; padding-right:50px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>
                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 20x; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;"> Announcement!!</div>
                            </td>
                        </tr>
                        <tr>
                            <td height="1" bgcolor="#DAE1E9"></td>
                        </tr>
                        <tr>
                            <td height="24" &nbsp;=""></td>
                        </tr>
                        @isset($announcement->title)
                        <tr>
                            <td style="padding-bottom: 10px; padding-top: 10px;">
                                <h2>{{$announcement->title}}</h2>
                            </td>
                        </tr>
                        @endisset
                        @isset($announcement->content)
                            <tr>
                            <td style="padding-bottom: 10px; padding-top: 10px;"> {{$announcement->content}}</td>
                        </tr>
                        @endisset
                        @isset($announcement->link)
                            <tr>
                            <td align="center">
                                <table style="width: 100%; border-collapse:collapse;">
                                    <tbody style="border: 0; padding: 0; margin-top:20px;">
                                    <tr>
                                        <td>
                                            <a href="{{ $announcement->link }}" target="_blank"
                                               class="f-fallback button button--brand">
                                                <span  style="color: white" id="button_text">Details</span>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endisset
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <p>
                            Sincerely, <br>
                            Team {{ $property->title }}<br>
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
