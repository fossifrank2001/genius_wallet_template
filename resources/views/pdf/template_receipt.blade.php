<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de transaction</title>
    <style>
        body {
            font-family: 'Candara', sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        h2 {
            font-size: 27px!important
        }

        p .children td{
            font-weight: lighter!important;
        }
    </style>
</head>
<body>

   <div class="Logo" style="margin-bottom: 24px; margin-top: -32px; margin-left: -24px">
       <img src="{{ $logo }}" alt="Afripay Logo" border="0" style="max-width: 150px; max-height: 150px;">
   </div>

    <div class="transaction-header" style="margin-bottom: 24px">
        <h2 style="padding:0 0!important; margin: 0!important">Reçu de transaction</h2>
        <p class="" style="padding: 7px 0!important; margin: 0">Reçu de transaction : {{ $transactionDate }}</p>
    </div>

    <div class="transaction-details">
        <!-- Type de transaction -->
        <div class="detail-group" style="border-bottom:  1px solid lightgray; padding: 10px 0!important;">
            <h2 style="padding:0 0!important; margin: 0!important">Type de transaction</h2>
            <p class="" style="padding: 7px 0!important; margin: 0">{{ $transactionType }}</p>
        </div>

        <!-- Expéditeur -->
        <div class="detail-group" style="border-bottom:  1px solid lightgray; padding: 10px 0!important;">
            <h2 style="padding:0 0!important; margin: 0!important">Expéditeur</h2>
            <table class="children" style="width: 100%; padding-top: 4px">
                <tr>
                    <td style="width: 50%; text-align: left">Numéro de téléphone</td>
                    <td style="width: 50%; text-align: right">{{ $senderPhone }}</td>
                </tr>
            </table>
        </div>

        <!-- Transaction -->
        <div class="detail-group" style="border-bottom:  1px solid lightgray; padding: 10px 0!important;">
            <h2 style="padding:0 0!important; margin: 0!important">Transaction</h2>
            <p  style="padding: 7px 0!important; margin: 0">Référence : {{ $transactionReference }}</p>
            <table class="children" style="width: 100%; padding-top: 4px">
                <tr>
                    <td style="width: 50%; text-align: left">Date</td>
                    <td style="width: 50%; text-align: right">{{ $transactionDate }}</td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: left">Montant reçu par le bénéficiaire</td>
                    <td style="width: 50%; text-align: right">{{ $amount }} FCFA</td>
                </tr>
            </table>
        </div>

        <!-- Bénéficiaire -->
        <div class="detail-group"  style="border-bottom:  1px solid lightgray; padding: 10px 0!important;">
            <h2 style="padding:0 0!important; margin: 0!important">Bénéficiaire</h2>
            <table class="children" style="width: 100%; padding-top: 4px">
                <tr>
                    <td style="width: 50%; text-align: left">Numéro de téléphone</td>
                    <td style="width: 50%; text-align: right">{{ $receiverPhone }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
