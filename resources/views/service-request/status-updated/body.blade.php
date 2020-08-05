<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tbody>
            <tr>
                <td align="center">
                    <!--[if (gte mso 9)|(IE)]>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td align="center" valign="top" width="600">
                                <![endif]-->
                                <table cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;border:1px solid #F3F3F3;">

                                    <!-- start main content -->
                                    <tbody>
                                    <tr>
                                        <td bgcolor="#ffffff">

                                            <!--[if (gte mso 9)|(IE)]>
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                                <tr>
                                                    <td align="center" valign="top" width="600">
                                            <![endif]-->
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody>
                                                <tr>
                                                    <td class="content-cell" align="left" valign="top" style="font-family:'Avenir',sans-serif;font-size:15px;line-height:20px;color:#444444;">
                                                        <div style="margin:0 auto; max-width:100%;">

                                                            <p style="margin-bottom: 10px;">Hi <strong>{{ $user->name }}</strong></p>
                                                            <span>Please check your service request Status in here. </span>
                                                            <h1 class="align-center" style="margin: 25px 0px;"> Service Request Status</h1>

                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 10px;">
                                                                <!-- Task card start -->
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-image:url({{ asset('logo/border.png') }});background-size:100% 100%;">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td valign="middle" style="padding:10px;">
                                                                                    @if($serviceRequest->status === \App\DbModels\ServiceRequest::STATUS_IN_PROGRESS)
                                                                                        <img src="{{asset('logo/inprogress.png')}}" width="80">
                                                                                    @elseif($serviceRequest->status === \App\DbModels\ServiceRequest::STATUS_ON_HOLD)
                                                                                        <img src="{{asset('logo/w3.png')}}" width="80">
                                                                                    @elseif($serviceRequest->status === \App\DbModels\ServiceRequest::STATUS_CANCELLED)
                                                                                        <img src="{{asset('logo/cancel.png')}}" width="80">
                                                                                    @elseif($serviceRequest->status === \App\DbModels\ServiceRequest::STATUS_RESOLVED)
                                                                                        <img src="{{asset('logo/solved.png')}}" width="80">
                                                                                    @endif
                                                                                </td>
                                                                                <td style="padding: 10px 0px;">
                                                                                    <h1 style="font-family:'Avenir',sans-serif;font-size:18px;color:#444444;font-weight:800;margin:0 0 4px 0;text-align:left;line-height:20px;">Status {{ ucwords(str_replace('_', ' ', $serviceRequest->status))}}</h1>
                                                                                    <p style="font-family:'Avenir',sans-serif;font-size:14px;color:#444444;font-weight:400;margin:0 0 5px 0;text-align:left;line-height:20px;">Service request Status changed to <span style="color: #004d46">{{ str_replace('_', ' ', $serviceRequest->status)}}</span> by {{ $statusUpdatedByUser->name}}</p>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            @if($serviceRequest->status === \App\DbModels\ServiceRequest::STATUS_RESOLVED)
                                                                <h1 style="font-family:'Avenir',sans-serif;font-size:22px;color:#444444;font-weight:800;margin:32px 0 12px 0;text-align:center;line-height:36px;">Please provide your feedback?</h1>
                                                                <p style="font-family:'Avenir',sans-serif;font-size:14px;color:#444444;font-weight:400;margin:15px 32px 5px 32px;text-align:center;line-height:20px;"><span style="font-family:'Avenir',sans-serif;font-size:18px;color:#fbb700;font-weight:800;margin:0 0 4px 0;text-align:left;line-height:20px;">*</span> Thanks for using SpmartProperty,Please tel us your experience.Your feedback help us better services. ⚡ </p>
                                                                <p style="text-align:center;margin:32px 0 0 0;display:block;"><a href="https://SmartProperty.xyz" target="_blank" style="font-family:'Avenir',sans-serif;border-radius:3px;border-width:0px;display:inline-block;font-size:16px;font-weight:600;letter-spacing:0px;line-height:14px;padding:16px 26px 16px 26px;text-decoration:none;background-color:#004d46;border-color:#44958C;color:#ffffff;">Go to my Feedback</a></p>
                                                                <p style="font-family:'Avenir',sans-serif;text-align:center;font-size:11px; color:#777;">or <a href="https://SmartProperty.xyz" style="color:#44958C;font-weight:bold;text-decoration:none;">click here</a></p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <!-- end main content -->

                                    </tbody>
                                </table>
                                <!--[if (gte mso 9)|(IE)]>
                            </td>
                        </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            <!-- end main content block -->
            </tbody>
        </table>
    </td>
</tr>
