<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('currencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:3|unique:currencies',
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'rate_to_usd' => 'required|numeric|min:0.0001',
            'is_base' => 'boolean'
        ]);

        // إذا كانت هذه العملة الأساسية، قم بإلغاء تحديد العملات الأخرى
        if ($request->is_base) {
            Currency::where('is_base', true)->update(['is_base' => false]);
        }

        Currency::create($request->all());

        return redirect()->route('currencies.index')
            ->with('success', 'تم إضافة العملة بنجاح');
    }

    public function edit(Currency $currency)
    {
        return view('currencies.edit', compact('currency'));
    }

    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'code' => 'required|string|size:3|unique:currencies,code,' . $currency->id,
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'rate_to_usd' => 'required|numeric|min:0.0001',
            'is_base' => 'boolean'
        ]);

        // إذا كانت هذه العملة الأساسية، قم بإلغاء تحديد العملات الأخرى
        if ($request->is_base) {
            Currency::where('is_base', true)->where('id', '!=', $currency->id)
                    ->update(['is_base' => false]);
        }

        $currency->update($request->all());

        return redirect()->route('currencies.index')
            ->with('success', 'تم تحديث العملة بنجاح');
    }

    public function destroy(Currency $currency)
    {
        if ($currency->accounts()->count() > 0) {
            return back()->withErrors(['currency' => 'لا يمكن حذف العملة لوجود حسابات مرتبطة بها']);
        }

        $currency->delete();
        return redirect()->route('currencies.index')
            ->with('success', 'تم حذف العملة بنجاح');
    }
}
