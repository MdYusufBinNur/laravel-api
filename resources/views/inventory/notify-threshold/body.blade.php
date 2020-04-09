<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
                <tr>
                    <td height="40"></td>
                </tr>
                <tr style="color:#4E5C6E; font-size:14px; line-height:20px; margin-top:20px;">
                    <td class="content" colspan="2" valign="top" align="center" style="padding-left:90px; padding-right:90px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td align="center" valign="bottom" colspan="2" cellpadding="3">
                                        <img alt="Coinbase" width="80" src="images/right.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" &nbsp;=""></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;">
                                            You have successfully added {{$inventory->quantity}} {{ $inventory->name }}, price at {{ $inventory->cost }} taka
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="24" &nbsp;=""></td>
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
                                            @isset($inventory->description)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Product Description</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    {{ $inventory->description  }}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->created_at)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Date</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    {{ $inventory->created_at->toDayDateTimeString()  }}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->quantity)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Quantity
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    <strong>{{ $inventory->quantity }}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->cost)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Amount
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    <strong>{{ $inventory->cost }}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->sku)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">SKU
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    <strong>{{ $inventory->sku }}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->manufacturer)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Product Manufacturer</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    {{$inventory->manufacturer}}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->location)
{{--                                            <tr>--}}
{{--                                                <td style="padding-bottom: 10px; padding-top: 10px;">warranty</td>--}}
{{--                                                <td style="padding-bottom: 10px; padding-top: 10px;">1 year warranty</td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Store place</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">{{$inventory->location}}</td>
                                            </tr>
                                            @endisset
                                            @isset($inventory->restockNote)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Note</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    {{$inventory->restockNote}}
                                                </td>
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
                                <tr>
                                    <td height="24" &nbsp;=""></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <a href="http://example.com" class="f-fallback button button--brand" target="_blank">Add More ..</a>
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
                    <td height="60"></td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
