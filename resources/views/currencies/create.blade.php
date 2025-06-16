@extends('layouts.app')

@section('title', 'إضافة عملة جديدة')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-coins me-2"></i>إضافة عملة جديدة</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('currencies.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">رمز العملة (3 أحرف) *</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                       id="code" name="code" value="{{ old('code') }}" maxlength="3" 
                                       placeholder="USD" required style="text-transform: uppercase;">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="symbol" class="form-label">الرمز المالي *</label>
                                <input type="text" class="form-control @error('symbol') is-invalid @enderror" 
                                       id="symbol" name="symbol" value="{{ old('symbol') }}" 
                                       placeholder="$" required>
                                @error('symbol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">اسم العملة *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="الدولار الأمريكي" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rate_to_usd" class="form-label">معدل التحويل للدولار *</label>
                        <input type="number" step="0.0001" min="0.0001" 
                               class="form-control @error('rate_to_usd') is-invalid @enderror" 
                               id="rate_to_usd" name="rate_to_usd" value="{{ old('rate_to_usd', '1') }}" required>
                        <div class="form-text">
                            مثال: إذا كان 1 دولار = 3.75 ريال، فإن معدل التحويل للريال هو 3.75
                        </div>
                        @error('rate_to_usd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_base" name="is_base" value="1" 
                               {{ old('is_base') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_base">
                            هذه هي العملة الأساسية
                        </label>
                        <div class="form-text">
                            العملة الأساسية تستخدم لحساب إجمالي الأرصدة وللمقارنات
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ
                        </button>
                        <a href="{{ route('currencies.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right me-2"></i>رجوع
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
