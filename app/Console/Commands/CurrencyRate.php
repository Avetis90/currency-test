<?php

namespace App\Console\Commands;

use App\Services\RateApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currency = '';
        if (Cache::has('currency')) {
            $currency = Cache::get('currency');
        }else{
            $result = RateApi::getRate();
            if ($result['success']){
                Cache::put('currency', $currency, 3600);
            }
            $currency = $result['rate'];
        }
        $this->info($currency);
    }
}
