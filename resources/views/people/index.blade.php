@extends('layouts.app')

@section('title', 'قائمة الأشخاص')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>قائمة الأشخاص</h2>
    <a href="{{ route('people.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>إضافة شخص جديد
    </a>
</div>

<div class="row">
    @forelse($people as $person)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-user me-2"></i>{{ $person->name }}
                    </h5>
                    
                    <div class="mb-3">
                        <strong>الحسابات:</strong>
                        @if($person->accounts->count() > 0)
                            @foreach($person->accounts as $account)
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="badge bg-secondary currency-badge">
                                        {{ $account->currency->code }}
                                    </span>
                                    <span class="fw-bold {{ $account->balance >= 0 ? 'balance-positive' : 'balance-negative' }}">
                                        {{ number_format($account->balance, 2) }} {{ $account->currency->symbol }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <small class="text-muted">لا توجد حسابات</small>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('people.show', $person) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> عرض
                        </a>
                        <a href="{{ route('people.edit', $person) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('people.destroy', $person) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الشخص؟')">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                لا يوجد أشخاص مسجلين. <a href="{{ route('people.create') }}">إضافة الشخص الأول</a>
            </div>
        </div>
    @endforelse
</div>
@endsection
