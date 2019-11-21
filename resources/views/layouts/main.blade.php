<!DOCTYPE html>
<html>
    @include('layouts.head')
    <body bgcolor="#f1f1f1" class="body" style="padding:0; margin:0; display:block; background:#f1f1f1; -webkit-text-size-adjust:none">
        <table align="center" cellpadding="0" cellspacing="0" class="force-full-width">
            <tbody>
                <tr>
                    <td align="center" bgcolor="#f1f1f1" valign="top" width="100%">
                        <center>
                            <table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
                                <tbody>
                                    <tr>
                                        <td height="20">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">
                                          @include('layouts.header')
                                          @include('layouts.body')
                                        </td>
                                    </tr>
                                    @include('layouts.footer')
                                </tbody>
                            </table>
                        </center>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
