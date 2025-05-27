@extends('layouts.app')

@section('title', 'Yangi Startap Yaratish')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Yangi Startap Yaratish</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('startups.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Startap nomi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Tavsif</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="industry" class="form-label">Soha</label>
                        <input type="text" class="form-control @error('industry') is-invalid @enderror" 
                               id="industry" name="industry" value="{{ old('industry') }}" required>
                        @error('industry')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="funding_goal" class="form-label">Maqsadli moliya ($)</label>
                        <input type="number" step="0.01" class="form-control @error('funding_goal') is-invalid @enderror" 
                               id="funding_goal" name="funding_goal" value="{{ old('funding_goal') }}" required>
                        @error('funding_goal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">Muddat</label>
                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                               id="deadline" name="deadline" value="{{ old('deadline') }}" required>
                        @error('deadline')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="founder_name" class="form-label">Asoschining ismi</label>
                        <input type="text" class="form-control @error('founder_name') is-invalid @enderror" 
                               id="founder_name" name="founder_name" value="{{ old('founder_name') }}" required>
                        @error('founder_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="founder_email" class="form-label">Asoschining emaili</label>
                        <input type="email" class="form-control @error('founder_email') is-invalid @enderror" 
                               id="founder_email" name="founder_email" value="{{ old('founder_email') }}" required>
                        @error('founder_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('startups.index') }}" class="btn btn-secondary">Bekor qilish</a>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection