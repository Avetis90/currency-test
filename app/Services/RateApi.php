<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class RateApi
{
    static function getRate()
    {
        $api_url = 'https://www.cbr-xml-daily.ru/latest.js';
        $options = [
            'verify' => false
        ];

        $response = Http::withOptions($options)->get($api_url);
        if ($response->successful()){
            $rate = $response->json()['rates']['USD'];
            return  ['rate' => '1 RUB = '.$rate.' USD','success' => true];
        }else{
            return  ['rate' => 'Ooops ! Something went wrong ...','success' => false];
        }

    }
}
