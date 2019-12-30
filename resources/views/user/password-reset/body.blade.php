<table bgcolor="#0292B7" cellpadding="0" cellspacing="0"
       class="force-full-width" style="margin: 0 auto;">
    <tbody >
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color:#ffffff;"><br>
                        Hey {{ $user->name }}
                        <br>
                        <br>
                        The support team received your request to reset your password. Click the button below to get started.
                        <br>
                        <br>
                        <div >
                            <!--[if mso]> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.sendwithus.com" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f"> <w:anchorlock></w:anchorlock> <center> <![endif]-->
                            <a  href="{{ $resetLink }}"
                                style="background-color:#DEE2EC;border-radius:4px;color:#000;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:180px;-webkit-text-size-adjust:none;">
                                <span id="button_text">Reset Password</span>
                            </a>
                            <!--[if mso]> </center> </v:roundrect> <![endif]-->
                        </div>
                        <br>
                        If it doesn’t work, you can copy and paste the following link in your browser:
                        <br>
                        <br>
                        {{ $resetLink }}
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr >
        <td >

            <br>
            <br>
            <br>
            <br>
        </td>
    </tr>
    </tbody>
</table>
<table bgcolor="#F5774E" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
    <tbody>
    <tr>
        <td style="background-color:#f5774e;">
            <center>

            </center>
        </td>
    </tr>
    </tbody>
</table>
