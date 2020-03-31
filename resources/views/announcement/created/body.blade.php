<table bgcolor="#4DBFBF" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
    <tbody>
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0"
                   style="margin: 0 auto;" width="80%">
                <tbody>
                <tr>
                    <td height="50">

                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size:18px;color:#ffffff; text-align: left;">
                        Dear Mr. {{ $user->name }}, <br> <br>

                       Announcement!!<br>
                        <br>
                        <br>
                        {{$announcement->title}}
                        <br>
                        <br>
                        {{$announcement->content}}
                        <br>
                        <br>
                        <br>
                        Sincerely, <br>
                        Team {{ $property->title }}
                        
                        <br>
                        <br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td>
            <div >
                <!--[if mso]> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.sendwithus.com" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f"> <w:anchorlock></w:anchorlock> <center> <![endif]-->
                <a href="{{ $announcement->link }}" target="_blank"
                   style="background-color:#89d6a3;border-radius:4px;color:#000;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:180px;-webkit-text-size-adjust:none;">
                    <span id="button_text">{{ $announcement->link }}</span>
                </a>
                <!--[if mso]> </center> </v:roundrect> <![endif]-->
            </div>
        </td>
    </tr>
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
