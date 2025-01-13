<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <style type="text/css">
        /* Réinitialisation des styles */
        body, p, table, td, div, h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        /* Styles principaux */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f4f4;
            padding-bottom: 40px;
        }
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
        }
        .header {
            padding: 0;
            text-align: center;
        }
        .header img {
            width: 150px;
            max-width: 90%;
            height: auto;
        }
        .title {
            background-color: #000f3c;
            padding: 16px;
            color: #ffffff;
            text-align: center;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .footer {
            background-color: #000f3c;
            color: #ffffff;
        }
        .footer-content {
            padding: 8px 30px;
        }
        .footer-text {
            font-size: 14px;
            line-height: 1.5;
            color: #ffffff;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .social {
            text-align: center;
        }
        .social a {
            display: inline-block;
            margin: 0 10px;
        }
        .social img, .social-right img {
            width: 30px;
            height: 30px;
        }
        .social-right{
            display: flex;
            flex-direction: column;

        }

        .social-right td {width: fit-content!important;}

        .social-right tbody{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        p {
            font-size: 18px;
            padding:  8px 0!important;
        }

        tr.disclaimer td{
            font-size: 11px!important;
            text-align: justify;
            color: #333;
            padding: 8px 30px!important;
        }

        tr.disclaimer td:first-child{
            text-align: center;
        }

        /* Media Queries pour la responsivité */
        @media screen and (max-width: 600px) {
            .main {
                width: 100% !important;
            }
            .header, .content, .footer-content {
                padding: 20px !important;
            }
            .title {
                font-size: 20px !important;
            }
        }
    </style>
</head>
<body>
<center class="wrapper">
    <table class="main" width="100%" cellpadding="0" cellspacing="0">
        <!-- En-tête -->
        <tr>
            <td class="header">
                <img src="{{ asset('assets/images/afripay.png') }}" alt="Afripay Logo" border="0">
            </td>
        </tr>

        <!-- Titre -->
        <tr>
            <td class="title">
                {{ $title }}
            </td>
        </tr>

        <!-- Contenu -->
        <tr>
            <td class="content">
                @yield('content')
            </td>
        </tr>

        <!-- Pied de page -->
        <tr>
            <td class="footer">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="footer-content">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="footer-text" style="width: 50%">
                                        <strong>Contact</strong><br>
                                        {{ env('CLIENT_ADDRESS') }}<br>
                                        <a href="tel:{{ env('CLIENT_PHONE_NUMBER') }}">{{ env('CLIENT_PHONE_NUMBER') }}</a><br>
                                        <a href="mailto:{{ env('CLIENT_EMAIL') }}">{{ env('CLIENT_EMAIL') }}</a>
                                    </td>
                                    <td style="width: 50%">
                                        <table class="social-right" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding-right: 20px; text-align: right">
                                                    <a href="#"><img src="{{ asset('assets/images/facebook.png') }}" alt="Facebook" border="0"></a>
                                                </td>
                                                <td style="padding-right: 20px; ">
                                                    <a href="#"><img src="{{ asset('assets/images/instagram.png') }}" alt="Instagram" border="0"></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="footer-text" colspan="2" style="text-align: center; padding-top: 10px;">
                                                    &copy; {{ date('Y') }} Company. All Rights Reserved.
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="disclaimer">
            <td class="content">This email was sent to you by Afripay. By using our services, you agree to our customer agreements.</td>
        </tr>
        <tr class="disclaimer">
            <td class="content">All investment services are provided by Afripay’s subsidiaries which are authorised and regulated to provide investment services. If you hold a Jar or an account under Assets, any communication about this will be from representatives of the relevant investment entity. All investment services are provided by the respective Afripay Assets entity in your location.</td>
        </tr>
        <tr class="disclaimer">
            <td class="content" style="text-align: center">© Afripay Finance 2024. All rights reserved.</td>
        </tr>
    </table>

</center>
</body>
</html>
