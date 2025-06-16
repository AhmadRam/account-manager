<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Person;
use App\Models\Currency;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $people = Person::all();
        $currencies = Currency::all();

        $query = Transaction::with(['account.person', 'account.currency']);

        // فلترة بالشخص
        if ($request->filled('person_id')) {
            $query->whereHas('account', function ($q) use ($request) {
                $q->where('person_id', $request->person_id);
            });
        }

        // فلترة بالعملة
        if ($request->filled('currency_id')) {
            $query->whereHas('account', function ($q) use ($request) {
                $q->where('currency_id', $request->currency_id);
            });
        }

        // فلترة بالتاريخ من
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // فلترة بالتاريخ إلى
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(50);

        return view('reports.index', compact('transactions', 'people', 'currencies', 'request'));
    }
}
