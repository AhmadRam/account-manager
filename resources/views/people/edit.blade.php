@extends('layouts.app')

@section('title', 'تعديل ' . $person->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-user-edit me-2"></i>تعديل {{ $person->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('people.update', $person) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $person->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>حفظ التغييرات
                        </button>
                        <a href="{{ route('people.show', $person) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right me-2"></i>رجوع
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
