<?php

namespace Database\Seeders;

use App\Modules\Currencies\Models\Crypto;
use App\Modules\Currencies\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config("bookkeeper.default.currencies") as $currency) {
            Currency::firstOrCreate(
                [ 'code' => $currency['code'], ],
                [
                    'name' => $currency['name'],
                ]
            );
        }
        foreach (config("bookkeeper.default.cryptos") as $currency) {
            Crypto::firstOrCreate(
                [ 'code' => $currency['code'], ],
                [
                    'name' => $currency['name'],
                ]
            );
        }
    }
}
