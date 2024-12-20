<?php

namespace App\Http\Controllers;

use App\Mail\DepositMail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function template(Request $request)
    {
        $type =  $request->get('type');

        $deposit = DB::connection('second_database')
            ->table('deposits')
            ->select(
                'deposits.*',
                'payment_gateways.name as gateway_name',
                'currencies.type as currency_type',
                'currencies.code as currency_code',
            )
            ->leftJoin('currencies', 'deposits.currency_id', '=', 'currencies.id')
            ->leftJoin('payment_gateways', 'deposits.method', '=', 'payment_gateways.id')
            ->first();

        if (!$deposit) {
            dd("No deposit found");
        }

        $wallet = DB::connection('second_database')
            ->table('wallets')
            ->select(
                'wallets.*',
                'currencies.type as currency_type',
            )
            ->leftJoin('currencies', 'wallets.currency_id', '=', 'currencies.id')
            ->where('currency_id', $deposit->currency_id)
            ->first();

        if (!$wallet) {
            dd("No wallet found for the given currency");
        }

        $user = DB::connection('second_database')
            ->table('users')
            ->where('id', $wallet->user_id)
            ->first();

        if (!$user) {
            dd("No user found for the given wallet");
        }

        $trnx = DB::connection('second_database')
            ->table('transactions')
            ->where('remark', $type)
            ->where('currency_id', $deposit->currency_id)
            ->first();

        if (!$trnx) {
            dd("No transaction found for the given criteria");
        }

        @mailSend('deposit_approve', [
            'amount' => amount($deposit->amount, $deposit->currency_type, 2),
            'curr'   => $deposit->currency_code,
            'trnx'   => $trnx->trnx,
            'method' => $deposit->gateway_name,
            'charge' => amount($deposit->charge, $deposit->currency_type, 2),
            'new_balance' => amount($wallet->balance, $wallet->currency_type, 2),
            'data_time' => dateFormat($trnx->created_at)
        ], $user);

    }


}
