@extends('layouts.app')

@section('title', 'تفاصيل ' . $person->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user me-2"></i>{{ $person->name }}</h2>
    <div class="btn-group">
        <a href="{{ route('people.edit', $person) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>تعديل الاسم
        </a>
        <a href="{{ route('people.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right me-2"></i>رجوع للقائمة
        </a>
    </div>
</div>

<div class="row">
    <!-- إضافة معاملة جديدة -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus-circle me-2"></i>إضافة معاملة</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('transactions.store', $person) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="currency_id" class="form-label">العملة</label>
                        <select class="form-select @error('currency_id') is-invalid @enderror" 
                                id="currency_id" name="currency_id" required>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" 
                                    {{ (old('currency_id', $usdCurrency ? $usdCurrency->id : '') == $currency->id) ? 'selected' : '' }}>
                                    {{ $currency->code }} - {{ $currency->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('currency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ</label>
                        <input type="number" step="0.01" 
                               class="form-control @error('amount') is-invalid @enderror" 
                               id="amount" name="amount" value="{{ old('amount') }}" required
                               placeholder="مثال: 100 للإيداع، -100 للسحب">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            استخدم الأرقام الموجبة للإيداع والأرقام السالبة للسحب
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="2">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-2"></i>إضافة المعاملة
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- الحسابات والمعاملات -->
    <div class="col-md-8">
        @if($person->accounts->count() > 0)
            @foreach($person->accounts as $account)
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>
                            <span class="badge bg-primary me-2">{{ $account->currency->code }}</span>
                            {{ $account->currency->name }}
                        </h5>
                        <h4 class="mb-0 {{ $account->balance >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($account->balance, 2) }} {{ $account->currency->symbol }}
                        </h4>
                    </div>
                    
                    @if($account->transactions->count() > 0)
                        <div class="card-body">
                            <h6>آخر 10 معاملات:</h6>
                            @foreach($account->transactions->take(10) as $transaction)
                                <div class="card mb-2 {{ $transaction->type == 'deposit' ? 'transaction-deposit' : 'transaction-withdrawal' }}">
                                    <div class="card-body py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-{{ $transaction->type == 'deposit' ? 'success' : 'danger' }}">
                                                    {{ $transaction->type_name }}
                                                </span>
                                                <span class="{{ $transaction->type == 'deposit' ? 'amount-positive' : 'amount-negative' }}">
                                                    {{ $transaction->type == 'deposit' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }} {{ $account->currency->symbol }}
                                                </span>
                                                @if($transaction->description)
                                                    <br><small class="text-muted">{{ $transaction->description }}</small>
                                                @endif
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted">{{ $transaction->created_at->format('Y-m-d H:i') }}</small>
                                                <br><small>الرصيد: {{ number_format($transaction->balance_after, 2) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($account->transactions->count() > 10)
                                <div class="text-center mt-3">
                                    <a href="{{ route('reports.index', ['person_id' => $person->id, 'currency_id' => $account->currency->id]) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-list me-2"></i>عرض جميع المعاملات
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="card-body">
                            <p class="text-muted mb-0">لا توجد معاملات لهذا الحساب</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                لا توجد حسابات لهذا الشخص. قم بإضافة معاملة لإنشاء حساب.
            </div>
        @endif
    </div>
</div>
@endsection
