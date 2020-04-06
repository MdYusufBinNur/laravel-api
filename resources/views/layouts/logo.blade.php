@if (!empty($property))
<tr>
    <td class="email-masthead">
        <a href="{{$property->getPropertyLink()}}" class="f-fallback email-masthead_name">
            <img alt="{{$property->title}}" src="{{$property->getPropertyLogoUrl()}}" style="border-width: 0px; width: 160px;" width="160">
        </a>
    </td>
</tr>
@else

    <tr>
        <td class="email-masthead">
            <a href="https://smartproperty.xyz" class="f-fallback email-masthead_name">
                <img alt="SmartProperty Forgot Password" src="{{ asset('logo/smartproperty.png')}}" style="border-width: 0px; width: 160px;" width="160">
            </a>
        </td>
    </tr>


@endif

