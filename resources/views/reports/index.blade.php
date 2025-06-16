@extends('layouts.app')

@section('title', 'التقارير')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-chart-line me-2"></i>تقارير المعاملات</h2>
</div>

<!-- فلاتر البحث -->
<div class="card mb-4">
    <div class="card-header">
        <h5><i class="fas fa-filter me-2"></i>فلاتر البحث</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reports.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <label for="person_id" class="form-label">الشخص</label>
                    <select class="form-select" id="person_id" name="person_id">
                        <option value="">جميع الأشخاص</option>
                        @foreach($people as $person)
                            <option value="{{ $person->id }}" {{ $request->person_id == $person->id ? 'selected' : '' }}>
                                {{ $person->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="currency_id" class="form-label">العملة</label>
                    <select class="form-select" id="currency_id" name="currency_id">
                        <option value="">جميع العملات</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ $request->currency_id == $currency->id ? 'selected' : '' }}>
                                {{ $currency->code }} - {{ $currency->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="date_from" class="form-label">من تاريخ</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="{{ $request->date_from }}">
                </div>
                
                <div class="col-md-2">
                    <label for="date_to" class="form-label">إلى تاريخ</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="{{ $request->date_to }}">
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-2"></i>بحث
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-refresh me-2"></i>إعادة تعيين
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- النتائج -->
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-list me-2"></i>نتائج البحث ({{ $transactions->total() }} معاملة)</h5>
    </div>
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>الشخص</th>
                            <th>العملة</th>
                            <th>النوع</th>
                            <th>المبلغ</th>
                            <th>الرصيد بعد العملية</th>
                            <th>الوصف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $transaction->account->person->name }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $transaction->account->currency->code }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'danger' }}">
                                        {{ $transaction->type_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="{{ $transaction->type == 'deposit' ? 'amount-positive' : 'amount-negative' }}">
                                        {{ $transaction->type == 'deposit' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                                        {{ $transaction->account->currency->symbol }}
                                    </span>
                                </td>
                                <td>{{ number_format($transaction->balance_after, 2) }} {{ $transaction->account->currency->symbol }}</td>
                                <td>{{ $transaction->description ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                لا توجد معاملات تطابق معايير البحث
            </div>
        @endif
    </div>
</div>
@endsection
