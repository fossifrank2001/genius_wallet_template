<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    /**
     * Generate a PDF file from a Blade view.
     *
     * @param string $viewName
     * @param string $documentFileName
     * @param string $storagePath
     * @param array $data
     * @param string|null $header
     * @param string|null $footer
     * @param string $orientation
     * @return array
     */
    public function dompdf(
        string $viewName,
        string $documentFileName,
        string $storagePath = 'public',
        array $data = [],
        string $header = null,
        string $footer = null,
        string $orientation = 'portrait'
    ): array {
        $pdf = PDF::loadView($viewName, $data);

        $pdf->setPaper('A4', $orientation);

//        $pdf->setOption('dpi', 150);
        $pdf->setOption('defaultFont', 'candara');
        if ($header) {
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);
            $pdf->setOption('header-html', $header);
        }
        if ($footer) {
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);
            $pdf->setOption('footer-html', $footer);
        }

        $fileContent = $pdf->output();
        $fullFilePath = $documentFileName . '.pdf';
        Storage::disk($storagePath)->put($fullFilePath, $fileContent);

        $responseHeader = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '.pdf"'
        ];

        return [$fullFilePath, $responseHeader];
    }
}
