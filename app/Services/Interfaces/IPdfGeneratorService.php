<?php

namespace App\Services\Interfaces;

use App\Models\Assure;
use App\Models\BulletinAdhesion;
use App\Models\Entite;
use App\Models\Produit;

interface IPdfGeneratorService
{
    public function generatePdf(
        BulletinAdhesion $record,
        Produit $product,
        Assure $assure,
        Entite $agency,
        ?string $header,
        ?string $footer,
        ?string $content,
    ): array;
    public function matchedHeaderRecords(string|null $_content): array | string | null;
}
