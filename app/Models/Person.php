<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    
    protected $fillable = [
        'name'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function getTotalBalanceInBaseCurrencyAttribute()
    {
        $total = 0;
        foreach ($this->accounts as $account) {
            $total += $account->currency->convertToBase($account->balance);
        }
        return $total;
    }
}
