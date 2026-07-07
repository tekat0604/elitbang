<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <!-- Tell iOS not to automatically link certain text strings. -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title></title>

    <!-- CSS Reset : BEGIN -->
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */

        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */

        html,
        body {
            font-family: sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }


        .container {
            width: 600px;
            margin: 10px auto;
            padding: 50px auto;
            padding-bottom: 100px;
            padding-top: 30px;
            border: 1px solid #3681c1;
        }

        .progressbar {
            margin: 0;
            padding: 0;
            counter-reset: step;
        }

        .progressbar li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 15px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }

        .progressbar li:before {
            width: 30px;
            height: 30px;
            content: counter(step);
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }

        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressbar li:first-child:after {
            content: none;
        }

        .progressbar li.active {
            color: green;
        }

        .progressbar li.active:before {
            border-color: green;
        }

        .progressbar li.active+li:after {
            background-color: green;
        }

        /* What it does: Stops email clients resizing small text. */

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */

        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */

        a[x-apple-data-detectors],
        /* iOS */

        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */

        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */

        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */

        img.g-img+div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */

        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */

        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }
        }

        /* iPhone 6+, 7+, and 8+ */

        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }

    </style>


    <style>
        /* What it does: Hover styles for buttons */

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td-primary:hover,
        .button-a-primary:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */

        @media screen and (max-width: 600px) {

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }

        }

    </style>
    <!-- Progressive Enhancements : END -->

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #ffffff;">
    <center style="width: 100%; background-color: #ffffff;">

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->
        
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">

            <!-- Email Body : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <!-- Email Header : BEGIN -->
                <!--<tr>
                    <td style="padding: 20px 0; text-align: center">
                        <img src="https://pbs.twimg.com/profile_images/1735706212/logop4tk4_png_400x400.png" width="100" height="50" alt="alt_text" border="0" style="height: auto;  font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                    </td>
	            </tr>-->
                <tr>
                    <td style="background-color: #ffffff;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 20px; font-size: 15px; line-height: 20px; color: #555555;">
                                    <h1 style="margin: 0; font-family: sans-serif; font-size: 16px; line-height: 10px; color: #333333; font-weight: normal;">
                                        <strong>Yth. <?= @$pengirim->nama?></strong></h1>
                                    <!--<small style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 16px; line-height: 30px; color: #333333; font-weight: normal;">
                                        di <?= @$pengirim->instansi!=null?$pengirim->instansi:'Tempat'?></small>-->
                                    <h2 style="margin: 0; font-family: sans-serif; font-size: 18px; line-height: 22px; color: #3681c1;  font-weight: bold;  text-align:left !important;"><i class="fa fa-pencil-square-o"></i>Detail aduan:</h2>
                                    <p style="margin: 0;">
                                        tanggal kirim: <?php echo @$pengirim->created?><br>
                                        isi aduan: <?php echo nl2br(@$pengirim->pesan) ?>
                                    </p>
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <td style="padding-top: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: justify;">
                                    <h2 style="margin: 0 0 10px 20px; font-family: sans-serif; font-size: 18px; line-height: 22px; color: #3681c1;  font-weight: bold;  text-align:left !important;"><i class="fa fa-pencil-square-o"></i> Balasan : </h2>
                                    <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: none; color: #555555;  text-align:left !important;">
                                        <li style="margin:0 0 10px 20px;" class="list-item-first"><?= nl2br(@$new_message)?></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

                <!-- Clear Spacer : BEGIN -->
                <tr>
                    <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;">
                        &nbsp;
                    </td>
                </tr>
                <!-- Clear Spacer : END -->

            </table>
            <!-- Email Body : END -->

            <!-- Email Footer : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                    <td style="padding: 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
                        <!--<webversion style="color: #cccccc; text-decoration: underline; font-weight: bold;">Kunjungi Web Kami</webversion>
                        <br>-->
                        BPBD Kota Surakarta
                        <br>
                        <span class="unstyle-auto-detected-links">
							Jl. A. Yani No.350-354, Manahan, Kec. Banjarsari,
                            <br>
                            Kota Surakarta, Jawa Tengah 57138
							<br>
							(0271) 7464455
						</span>
                        <br><br>
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->
        </div>
    </center>
</body>

</html>
