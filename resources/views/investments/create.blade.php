@extends('layouts.app')

@section('title', 'Yangi Investitsiya Yaratish')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Yangi Investitsiya Yaratish</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('investments.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="startup_id" class="form-label">Startap</label>
                        <select class="form-control @error('startup_id') is-invalid @enderror" 
                                id="startup_id" name="startup_id" required>
                            <option value="">Startapni tanlang</option>
                            @foreach($startups as $startup)
                                <option value="{{ $startup->id }}" {{ old('startup_id') == $startup->id ? 'selected' : '' }}>
                                    {{ $startup->name }} (Maqsad: ${{ number_format($startup->funding_goal, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('startup_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="investor_id" class="form-label">Investor</label>
                        <select class="form-control @error('investor_id') is-invalid @enderror" 
                                id="investor_id" name="investor_id" required>
                            <option value="">Investorni tanlang</option>
                            @foreach($investors as $investor)
                                <option value="{{ $investor->id }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                                    {{ $investor->name }} (Byudjet: ${{ number_format($investor->total_budget, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('investor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Investitsiya miqdori ($)</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                               id="amount" name="amount" value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Izohlar</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('investments.index') }}" class="btn btn-secondary">Bekor qilish</a>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection