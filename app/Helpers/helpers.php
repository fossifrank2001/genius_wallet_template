<?php

use App\Mail\DepositMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

if (! function_exists('mailSend')) {
    function mailSend($key, array $data, $user): void
    {
        $gs = DB::connection('second_database')->table('generalsettings')->first();
        $template = DB::connection('second_database')->table('email_templates')->where('email_type', $key)->first();


        if ($gs->email_notify) {
            $data['current_date'] = Carbon::now()->format('F j, Y, g:i A');
            $data['transaction_type'] = $key;
            $data['sender_name'] = $user->name;
            $data['user_phone'] = $user->phone;
            $data['amount_received'] = $data['amount'] ?? null;
            $data['transaction_date'] = $data['date_time'] ?? null;
            $data['email_subject'] = $template->email_subject;

            $messageBody = str_replace('{name}', $user->name, $template->email_body);

            foreach ($data as $placeholder => $value) {
                if ($placeholder == 'data_time') {
                    $placeholder = 'date_time';
                }
                $messageBody = str_replace("{" . $placeholder . "}", $value, $messageBody);
            }

            //dd($messageBody);
            Mail::to($user->email)
                ->send(new DepositMail($data, $messageBody, $gs));
        }

        if ($gs->sms_notify) {
            $smsMessage = str_replace('{name}', $user->name, $template->sms);
            foreach ($data as $key => $value) {
                $smsMessage = str_replace("{" . $key . "}", $value, $smsMessage);
            }
            //sendSMS($user->phone, $smsMessage, $gs->contact_no);
        }
    }
}

function numFormat($amount, $length = 0)
{
    if (0 < $length) return number_format($amount + 0, $length);
    return $amount + 0;
}

function amount($amount, $type = 1, $length = 0)
{
    if ($type == 2) return numFormat($amount, 8);
    else return numFormat($amount, $length);
}

function dateFormat($date, $format = 'd M Y -- h:i a')
{
    return Carbon::parse($date)->format($format);
}
