<tr>
    <td>
        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tbody>
                <tr>
                    @if(!empty($property))
                    <td class="content-cell" align="center">
                        <p class="f-fallback sub align-center">
                            {{$property->title}}
                            <br>{{$property->address}},
                            <br>{{$property->city}} {{$property->postCode}},{{$property->country}}
                        </p>
                        <p class="f-fallback sub align-center">©{{ now()->year }} SmartProperty.xyz, All rights reserved.</p>
                    </td>
                    @else
                    <td class="content-cell" align="center">
                        <p class="f-fallback sub align-center">
                            SmartProperty.xyz
                            <br>Dhaka, Bangladesh
                        </p>
                        <p class="f-fallback sub align-center">©{{ now()->year }} SmartProperty.xyz, All rights reserved.</p>
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </td>
</tr>
