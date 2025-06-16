@extends('layouts.app')

@section('title', 'إدارة العملات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-coins me-2"></i>إدارة العملات</h2>
    <a href="{{ route('currencies.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>إضافة عملة جديدة
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($currencies->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>الرمز</th>
                            <th>الاسم</th>
                            <th>الرمز المالي</th>
                            <th>معدل التحويل للدولار</th>
                            <th>العملة الأساسية</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencies as $currency)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $currency->code }}</span>
                                </td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->symbol }}</td>
                                <td>{{ number_format($currency->rate_to_usd, 4) }}</td>
                                <td>
                                    @if($currency->is_base)
                                        <span class="badge bg-success">نعم</span>
                                    @else
                                        <span class="badge bg-secondary">لا</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('currencies.edit', $currency) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('currencies.destroy', $currency) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('هل أنت متأكد من حذف هذه العملة؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                لا توجد عملات مسجلة. <a href="{{ route('currencies.create') }}">إضافة العملة الأولى</a>
            </div>
        @endif
    </div>
</div>
@endsection
