<table bgcolor="#0292B7" cellpadding="0" cellspacing="0"
       class="force-full-width" style="margin: 0 auto;">
    <tbody >
    <tr>
        <td align="center" width="600" bgcolor="#ffffff"><img src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" style="display:block" alt="" border="0" height="45" width="1" />
            <table cellpadding="0" cellspacing="0" border="0" class="r-4" width="100%">
                <tr>
                    <td><img style="display:block" src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" height="1" border="0" alt="" width="49" /></td>
                    <td align="left" valign="top" width="100%">
                        <table border="0" cellpadding="0" cellspacing="0" class="r-2" width="100%">
                            <tr>
                                <td align="center" valign="top"><span style="font-family:Arial, sans-serif;font-size:30px;font-weight:bold;text-decoration:none;font-style:normal;mso-line-height-rule:exactly;line-height:100%;color:#283663;" class="text H1">Approved!<br /></span></td>
                            </tr>
                        </table><img src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" style="display:block" alt="" border="0" height="30" width="1" /></td>
                    <td><img style="display:block" src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" height="1" border="0" alt="" width="49" /></td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="r-4" width="100%">
                <tr>
                    <td><img style="display:block" src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" height="1" border="0" alt="" width="49" /></td>
                    <td align="left" valign="top" width="100%">
                        <table border="0" cellpadding="0" cellspacing="0" class="r-2" width="100%">
                            <tr>
                                <td align="left" style="text-align: left !important;" valign="top">
                                    <span style="font-family:Arial, sans-serif;font-size:20px;font-weight:bold;text-decoration:none;font-style:normal;mso-line-height-rule:exactly;line-height:100%;color:#283663;" class="text H1">Hey {{ $residentAccessRequest->name }}<br /></span><br />
                                    <span style="  font-family:Arial, sans-serif;font-size:15px;font-weight:normal;text-decoration:none;font-style:normal;mso-line-height-rule:exactly;line-height:20px;color:#717B81;" class="text P1">We're ready when you are! You're pretty much up and running.
                                        We reviewed and approved your request. Now you can continue your further registration by clicking on below continue registration button <br />
                                        <br />Some Credential You Need for continue registration: - <br /></span>
                                </td>
                            </tr>
                        </table><img src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" style="display:block" alt="" border="0" height="30" width="1" /></td>
                    <td><img style="display:block" src="http://ec2-54-93-116-216.eu-central-1.compute.amazonaws.com/i.gif" height="1" border="0" alt="" width="49" /></td>
                </tr>
            </table>

            <table class="promotion" align="left" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; border: 2px solid #9BA2AB; margin: 0; margin-bottom: 25px; margin-top: 15px; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <span
                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e;  margin-top: 0; text-align: left; font-size: 15px; font-weight: bold;">
                            Community:  {{$property->title}}
                        </span>
                        <br>
                        <span style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e;  margin-top: 0; text-align: left; font-size: 15px; font-weight: bold;">
                            Unit:  {{$unit->title}}
                        </span >
                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #edeff2; margin-top: 25px; padding-top: 25px;">
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                    <span
                                        style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: blue;  margin-top: 0; text-align: left; font-size: 15px; font-weight: bold;">
                                        Pin: {{$residentAccessRequest->pin}}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td>
                        <div >
                            <!--[if mso]> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.sendwithus.com" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f"> <w:anchorlock></w:anchorlock> <center> <![endif]-->
                            <a href="{{ url($propertyLink .'/registration') }}"
                                style="background-color:#89d6a3;border-radius:4px;color:#000;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:180px;-webkit-text-size-adjust:none;">
                                <span id="button_text">Complete registration</span>
                            </a>
                            <!--[if mso]> </center> </v:roundrect> <![endif]-->
                        </div>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="80%">
                <tbody>
                <tr >
                    <td  style="text-align:left; font-size:18px;color: black;"><br>
                        <br>
                        Thank You
                        <br>
                        {{ $property->title }} Support Team
                        <br>
                        <br>
                        {{ $property->address }}
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
