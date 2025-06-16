<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        $currencies = [
            [
                'code' => 'USD',
                'name' => 'الدولار الأمريكي',
                'symbol' => '$',
                'rate_to_usd' => 1.0000,
                'is_base' => true
            ],
            [
                'code' => 'SAR',
                'name' => 'الريال السعودي',
                'symbol' => 'ر.س',
                'rate_to_usd' => 3.7500,
                'is_base' => false
            ],
            [
                'code' => 'EUR',
                'name' => 'اليورو',
                'symbol' => '€',
                'rate_to_usd' => 0.8500,
                'is_base' => false
            ],
             [
                'code' => 'TRY',
                'name' => 'الليرة التركية',
                'symbol' => '₺',
                'rate_to_usd' => 27.5000,
                'is_base' => false
            ],
            [
                'code' => 'SYP',
                'name' => 'الليرة السورية',
                'symbol' => 'ل.س',
                'rate_to_usd' => 2512.0000,
                'is_base' => false
            ]
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                $currency
            );
        }
    }
}
