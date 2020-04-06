<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1>Hey {{ $residentAccessRequest->name }}</h1>
                        <p>We're ready when you are! You're pretty much up and running. We reviewed and pleased to inform you that we approved your request. Now you can continue your further registration by clicking on below continue registration button</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tbody>
                            <tr>
                                <td class="attributes_container">
                                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                        <tbody>
                                        <tr>
                                            <td class="attributes_item"><strong>Community: &nbsp;</strong>{{$property->title}}</td>
                                        </tr>
                                        <tr>
                                            <td class="attributes_item"><strong>Unit: &nbsp;</strong>{{$unit->title}}</td>
                                        </tr>
                                        <tr>
                                            <td height="30">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <div class="f-fallback">
                                                    <table class="discount" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                        <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <h1 class="f-fallback discount_heading">{{$residentAccessRequest->pin}}</h1>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <a href="{{ $completeRegistrationLink }}" class="f-fallback button button--brand" target="_blank">Complete registration</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>
                                                    Thanks,
                                                    <br>
                                                    {{ $property->title }} Support Team
                                                    <br>
                                                    {{ $property->address }}
                                                </p>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
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

