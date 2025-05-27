@extends('layouts.app')

@section('title', 'Investorni tahrirlash: ' . $investor->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Investorni tahrirlash: {{ $investor->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('investors.update', $investor) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Investor nomi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $investor->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $investor->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $investor->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="3">{{ old('bio', $investor->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total_budget" class="form-label">Umumiy byudjet ($)</label>
                        <input type="number" step="0.01" class="form-control @error('total_budget') is-invalid @enderror" 
                               id="total_budget" name="total_budget" value="{{ old('total_budget', $investor->total_budget) }}" required>
                        @error('total_budget')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="investor_type" class="form-label">Investor turi</label>
                        <select class="form-control @error('investor_type') is-invalid @enderror" 
                                id="investor_type" name="investor_type" required>
                            <option value="">Tanlang</option>
                            <option value="individual" {{ old('investor_type', $investor->investor_type) == 'individual' ? 'selected' : '' }}>Jismoniy shaxs</option>
                            <option value="company" {{ old('investor_type', $investor->investor_type) == 'company' ? 'selected' : '' }}>Kompaniya</option>
                            <option value="fund" {{ old('investor_type', $investor->investor_type) == 'fund' ? 'selected' : '' }}>Fond</option>
                        </select>
                        @error('investor_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('investors.show', $investor) }}" class="btn btn-secondary">Bekor qilish</a>
                        <button type="submit" class="btn btn-primary">Yangilash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection