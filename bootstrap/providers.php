<?php

use Barryvdh\DomPDF\ServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\PdfServiceProvider::class,
    ServiceProvider::class,
];
