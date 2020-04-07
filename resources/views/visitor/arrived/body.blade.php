<!-- Email Body start-->
<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content Start -->
            <tbody>
            <tr>
                <td height="40"></td>
            </tr>
            <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px;">
                <td class="content" colspan="2" valign="top" align="center" style="padding-left:90px; padding-right:90px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                        <tbody>
                        <tr>
                            <td align="center">
                                <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;"> Visitor Info</div>
                            </td>
                        </tr>
                        <tr>
                            <td height="1" bgcolor="#DAE1E9"></td>
                        </tr>
                        <tr>
                            <td height="24" &nbsp;=""></td>
                        </tr>
                        <!-- Image part Start -->
                        @isset($visitor->image)
                        <tr>
                            <td align="center">
                                <img src="{{$visitor->image->getFileUrl('thumbnail')}}">
                            </td>
                        </tr>
                        @endisset
                        <!-- Image part End -->
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td>
                                <table  align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td align="center">
                                            <h1 class="f-fallback discount_heading">{{$visitor->name}}</h1>
                                            <span class="f-fallback "><strong>Arrived at: </strong>{{$visitor->signInAt->toDayDateTimeString() }}</span> br
                                            @isset($visitor->unitId)
                                            <span><strong>To Unit: </strong>{{$visitor->unit->title}}</span> <br>
                                            @endisset
                                            @isset($visitor->userId)
                                                <span><strong>To Resident: </strong>{{$visitor->user->name}}</span> <br>
                                            @endisset
                                            <span><strong>Email: </strong>{{$visitor->email}}</span>
                                            <span><strong>Phone: </strong>{{$visitor->phone}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="60"></td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
<!-- Body content end -->
