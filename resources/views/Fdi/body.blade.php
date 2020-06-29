<tr>
    <td class="email-body" width="570" cellpadding="0" cellspacing="0">
        <table class="email-body_inner" style=" border: 1px solid #e1e1e1;" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Body content -->
            <tbody>
            <tr>
                <td class="content-cell">
                    <div class="f-fallback">
                        <h1> Hey {{ $staffUser->name }}</h1>
                        <p>
                           An Authorized Guest Request Created from <strong>Unit: {{$unit->title}}</strong>
                        </p>
                        <p>
                            Please check the request and take an action about the request
                        </p>
                    </div>
                </td>
            </tr>
            @isset($fdiRequestLink)
                <tr >
                    <td class="content-cell" align="center">
                        <a href="{{ $fdiRequestLink }}" class="f-fallback button button--brand" target="_blank">
                            <span style="color: white">Request link</span>
                        </a>
                        <br>
                        <br>
                    </td>
                </tr>
            @endisset
            </tbody>
        </table>
    </td>
</tr>
