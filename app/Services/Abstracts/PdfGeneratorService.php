<?php

namespace App\Services\Abstracts;

use App\Models\Assure;
use App\Models\BulletinAdhesion;
use App\Models\Entite;
use App\Models\Produit;
use App\Services\Interfaces\IPdfGeneratorService;
use function App\Services\Concretes\public_path;

class PdfGeneratorService implements IPdfGeneratorService
{
    public function matchedHeaderRecords(?string $_content): array|string|null
    {
        if (!$_content) {
            return null;
        }

        $logoNFCBankPath = public_path('assets/images/NFC-Bank.png');
        $logoAcamviePath = public_path('assets/images/acamvie1.png');

        $NFC_BANK_LOGO = base64_encode(file_get_contents($logoNFCBankPath));
        $ACAMVIE_LOGO = base64_encode(file_get_contents($logoAcamviePath));

        $content = str_replace('{{NFC_BANK_LOGO}}', 'data:image/png;base64,' . $NFC_BANK_LOGO, $_content);
        $content = str_replace('{{ACAMVIE_LOGO}}', 'data:image/png;base64,' . $ACAMVIE_LOGO, $content);

        return $content;
    }

    public function generatePdf(
        BulletinAdhesion $record,
        Produit $product,
        Assure $assure,
        Entite $agency,
        ?string $header,
        ?string $footer,
        ?string $content,
    ): array {
        return [];
    }
}
