<?php

return [
    App\Providers\AppServiceProvider::class,
    //App\Providers\RouteServiceProvider::class,

    Spatie\Html\HtmlServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
    Intervention\Image\ImageServiceProvider::class,
    Barryvdh\Elfinder\ElfinderServiceProvider::class,
    Unicodeveloper\Paystack\PaystackServiceProvider::class,
    Cartalyst\Stripe\Laravel\StripeServiceProvider::class,
];
