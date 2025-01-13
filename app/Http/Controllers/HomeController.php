<?php

namespace App\Http\Controllers;

use App\Mail\DepositMail;
use App\Services\PdfService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HomeController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }
    public function template(Request $request): void
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
            Log::error("No deposit found");
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
            Log::error("No wallet found for the given currency");
        }

        $user = DB::connection('second_database')
            ->table('users')
            ->where('id', $wallet->user_id)
            ->first();

        if (!$user) {
            Log::error("No user found for the given wallet");
        }

        $trnx = DB::connection('second_database')
            ->table('transactions')
            ->where('remark', $type)
            ->where('currency_id', $deposit->currency_id)
            ->first();

        if (!$trnx) {
            Log::error("No transaction found for the given criteria");
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



    public function generate(): BinaryFileResponse
    {
        $logoAfriPay = public_path('assets/images/afripay.png');
        $AFRI_PAY_LOGO = 'data:image/png;base64,' . base64_encode(file_get_contents($logoAfriPay));

        $data = [
            'logo' => $AFRI_PAY_LOGO,
            'transactionDate' => '09-11-2024, 08:18 PM',
            'transactionType' => 'P2P',
            'senderPhone' => '697386078',
            'transactionReference' => 'PP241109.2018.C14133',
            'amount' => '5075.0',
            'receiverPhone' => '694209664',
            'title' => 'Transaction Receipt',
        ];

        [$filePath, $headers] = $this->pdfService->dompdf(
            'pdf.template_receipt',
            'transaction_receipt',
            'public',
            $data
        );

        $fullPath = Storage::disk('public')->path($filePath);

        return response()->file($fullPath, $headers);
    }
}
