<table bgcolor="#4DBFBF" cellpadding="0" cellspacing="0" class="force-full-width" style="margin: 0 auto;">
    <tbody>
    <tr>
        <td><br>
            <img alt="robot picture" height="240"
                 src="https://www.filepicker.io/api/file/carctJpuT0exMaN8WUYQ"
                 width="224">
        </td>
    </tr>

    <tr>
        <td class="headline"><br>
            <strong>Greetings
                <span id="first_name">
                        {{$contactName}}
                    </span>!
            </strong>
        </td>
    </tr>

    <tr>
        <td>
            <center>
                <table cellpadding="0" cellspacing="0"
                       style="margin: 0 auto;" width="60%">
                    <tbody>
                    <tr>
                        <td style="font-size:18px;color:#ffffff;">
                            <br>
                            Payment Info: <br>
                            <hr>
                            Amount: {{$payment->amount}} <br>
                            Type: {{$payment->paymentType->title}}
                            Note: {{$payment->note}} <br>
                            Method: {{$payment->method}} <br>
                            Due Date: {{$payment->dueDate}} <br>
                            Status Date: {{$paymentItem->status}} <br>
                            <hr>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>

    <tr>
        <td>
            <div>
                <!--[if mso]> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.sendwithus.com" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f"> <w:anchorlock></w:anchorlock> <center> <![endif]-->
                <a href="https://reformedtech.org/"
                   style="background-color:#178f8f;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:250px;-webkit-text-size-adjust:none;">
                    <span id="button_text">Button</span>
                </a>
                <!--[if mso]> </center> </v:roundrect> <![endif]-->
            </div>
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
