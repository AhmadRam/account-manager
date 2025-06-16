<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'symbol', 'rate_to_usd', 'is_base'
    ];

    protected $casts = [
        'rate_to_usd' => 'decimal:4',
        'is_base' => 'boolean'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public static function getBaseCurrency()
    {
        return self::where('is_base', true)->first();
    }

    public function convertToBase($amount)
    {
        $baseCurrency = self::getBaseCurrency();
        if ($this->id === $baseCurrency->id) {
            return $amount;
        }
        return $amount / $this->rate_to_usd * $baseCurrency->rate_to_usd;
    }
}
