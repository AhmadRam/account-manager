<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id', 'type', 'amount', 'balance_before', 'balance_after', 'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getTypeNameAttribute()
    {
        return $this->type === 'deposit' ? 'إيداع' : 'سحب';
    }

    public function getSignedAmountAttribute()
    {
        return $this->type === 'deposit' ? $this->amount : -$this->amount;
    }
}
