<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id', 'currency_id', 'balance'
    ];

    protected $casts = [
        'balance' => 'decimal:2'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('created_at', 'desc');
    }

    public function addTransaction($amount, $description = null)
    {
        $balanceBefore = $this->balance;
        $type = $amount >= 0 ? 'deposit' : 'withdrawal';
        $actualAmount = abs($amount);
        
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => $type,
            'amount' => $actualAmount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'description' => $description
        ]);
    }
}
