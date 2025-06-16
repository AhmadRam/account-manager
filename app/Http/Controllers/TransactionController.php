<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Person $person)
    {
        $request->validate([
            'currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|numeric|not_in:0',
            'description' => 'nullable|string'
        ]);

        // البحث عن الحساب أو إنشاؤه
        $account = Account::firstOrCreate([
            'person_id' => $person->id,
            'currency_id' => $request->currency_id
        ], [
            'balance' => 0
        ]);

        // التحقق من كفاية الرصيد للسحب (المبلغ السالب)
        if ($request->amount < 0 && ($account->balance + $request->amount) < 0) {
            return back()->withErrors(['amount' => 'الرصيد غير كافي للسحب']);
        }

        // إضافة المعاملة
        $account->addTransaction(
            $request->amount,
            $request->description
        );

        return redirect()->route('people.show', $person)
            ->with('success', 'تم تسجيل المعاملة بنجاح');
    }
}
