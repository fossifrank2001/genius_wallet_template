@extends('layout',['title' => trans("Afripay Wallet | "). $data['email_subject']])

@section("content")
    <style>
    </style>

    <div class="u-row-container" style="padding: 0;background-color: transparent">
        <div class="u-row"
             style="margin: 0 auto;min-width: 420px;max-width: 800px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
            <div
                style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                <!--[if (mso)|(IE)]>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding: 0px 0px 32px;background-color: transparent;" align="center">
                            <table cellpadding="0" cellspacing="0" border="0" style="width:800px;">
                                <tr style="background-color: #ffffff;"><![endif]-->

                <!--[if (mso)|(IE)]>
                <td align="center" width="800"
                    style="width: 800px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"
                    valign="top"><![endif]-->
                <div class="u-col u-col-100"
                     style="max-width: 420px;min-width: 800px;display: table-cell;vertical-align: top;">
                    <div style="height: 100%;width: 100% !important;">
                        <!--[if (!mso)&(!IE)]><!-->
                        <div
                            style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                            <!--<![endif]-->

                            <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0"
                                   cellspacing="0" width="100%" border="0">
                                <tbody>
                                <tr>
                                    <td style="overflow-wrap:break-word;word-break:break-word;padding:40px 40px 30px;font-family:'Lato',sans-serif;"
                                        align="left">

{{--                                        @dd($data)--}}
                                        {!! $content !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                    </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
            </div>
        </div>
    </div>

@endsection
