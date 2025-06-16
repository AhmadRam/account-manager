<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Currency;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $people = Person::with('accounts.currency')->get();
        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Person::create($request->all());

        return redirect()->route('people.index')
            ->with('success', 'تم إضافة الشخص بنجاح');
    }

    public function show(Person $person)
    {
        $person->load(['accounts.currency', 'accounts.transactions']);
        $currencies = Currency::all();
        $usdCurrency = Currency::where('code', 'USD')->first();
        return view('people.show', compact('person', 'currencies', 'usdCurrency'));
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $person->update($request->all());

        return redirect()->route('people.show', $person)
            ->with('success', 'تم تحديث بيانات الشخص بنجاح');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('people.index')
            ->with('success', 'تم حذف الشخص بنجاح');
    }
}
