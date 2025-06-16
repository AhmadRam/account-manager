@extends('layouts.app')

@section('title', 'تعديل العملة')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit me-2"></i>تعديل {{ $currency->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('currencies.update', $currency) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">رمز العملة (3 أحرف) *</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                       id="code" name="code" value="{{ old('code', $currency->code) }}" 
                                       maxlength="3" required style="text-transform: uppercase;">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="symbol" class="form-label">الرمز المالي *</label>
                                <input type="text" class="form-control @error('symbol') is-invalid @enderror" 
                                       id="symbol" name="symbol" value="{{ old('symbol', $currency->symbol) }}" required>
                                @error('symbol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">اسم العملة *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $currency->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rate_to_usd" class="form-label">معدل التحويل للدولار *</label>
                        <input type="number" step="0.0001" min="0.0001" 
                               class="form-control @error('rate_to_usd') is-invalid @enderror" 
                               id="rate_to_usd" name="rate_to_usd" 
                               value="{{ old('rate_to_usd', $currency->rate_to_usd) }}" required>
                        @error('rate_to_usd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_base" name="is_base" value="1" 
                               {{ old('is_base', $currency->is_base) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_base">
                            هذه هي العملة الأساسية
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ التغييرات
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
