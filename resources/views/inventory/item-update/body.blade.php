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
                                        <img alt="Inventory Item" width="80" src="{{ env('ASSET_PATH') . '/logo/right.png' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" &nbsp;=""></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="font-size: 22px; line-height: 32px; font-weight: 500; margin-left: 20px; margin-right: 20px; margin-bottom: 25px;">
                                            Inventory item <strong>{{ $inventoryItem->name }}</strong> has been updated
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
                                            @isset($inventoryItem->description)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Product Description</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : {{ $inventoryItem->description  }}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItemLog->created_at)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Date</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : {{ $inventoryItemLog->created_at->toDayDateTimeString()  }}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItemLog->quantityChange)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Quantity Changed
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : <strong>{{ $inventoryItemLog->quantityChange > 0 ? '+' . $inventoryItemLog->quantityChange : $inventoryItemLog->quantityChange}}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItem->quantity)
                                                <tr>
                                                    <td style="padding-bottom: 10px; padding-top: 10px;">Current Quantity
                                                        <br>
                                                    </td>
                                                    <td style="padding-bottom: 10px; padding-top: 10px;">
                                                        : <strong>{{ $inventoryItem->quantity}}</strong>
                                                        <br>
                                                    </td>
                                                </tr>
                                            @endisset
                                            @isset($inventoryItemLog->cost)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Cost
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : <strong>{{ $inventoryItemLog->cost }}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItem->sku)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">SKU
                                                    <br>
                                                </td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : <strong>{{ $inventoryItem->sku }}</strong>
                                                    <br>
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItem->vendorId)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Vendor</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : {{$inventoryItem->vendor->name}}
                                                </td>
                                            </tr>
                                            @endisset
                                            @isset($inventoryItem->restockNote)
                                            <tr>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">Note</td>
                                                <td style="padding-bottom: 10px; padding-top: 10px;">
                                                    : {{$inventoryItem->restockNote}}
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
