<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> Hello </h1>
                        <h1> {{$company->title}} </h1>
                        <p style="margin-bottom: 5px;"> An Enterprise User has been created for your company.</p>
                    </div>
                </td>
            </tr>
            <tr style="color:#4E5C6E; font-size:14px; line-height:15px;">
                <td class="content" colspan="2" valign="top" align="center" style="padding-left:30px; padding-right:30px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>
                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 20x; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;">
                                    User Details
                                </div>
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
                                        <td width="30%" style="margin-bottom: 10px;">
                                            <span class="f-fallback"><strong>Name</strong></span>
                                        </td>
                                        <td class="align-left" width="70%" style="margin-bottom: 10px;">
                                            <span class="f-fallback">{{$user->name}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="" style="margin-bottom: 10px;">
                                            <span class="f-fallback"><strong>E-mail</strong></span>
                                        </td>
                                        <td class="align-left" width="70%" style="margin-bottom: 10px;">
                                            <span class="f-fallback">{{$enterpriseUser->contactEmail}}</span>
                                        </td>
                                    </tr>
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
                    <div class="f-fallback">
                        <p>
                            Regards, <br>
                            Smart Property Team
                        </p>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>



