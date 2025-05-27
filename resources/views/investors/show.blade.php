@extends('layouts.app')

@section('title', $investor->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>{{ $investor->name }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $investor->email }}</p>
                        @if($investor->phone)
                            <p><strong>Telefon:</strong> {{ $investor->phone }}</p>
                        @endif
                        <p><strong>Turi:</strong> 
                            <span class="badge bg-info">{{ ucfirst($investor->investor_type) }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Umumiy byudjet:</strong> ${{ number_format($investor->total_budget, 2) }}</p>
                        <p><strong>Investitsiya qilingan:</strong> ${{ number_format($investor->total_invested, 2) }}</p>
                        <p><strong>Qolgan byudjet:</strong> ${{ number_format($investor->total_budget - $investor->total_invested, 2) }}</p>
                    </div>
                </div>

                @if($investor->bio)
                    <div class="mb-3">
                        <p><strong>Bio:</strong></p>
                        <p>{{ $investor->bio }}</p>
                    </div>
                @endif

                @if($investor->preferred_industries)
                    <div class="mb-3">
                        <p><strong>Afzal ko'rgan sohalar:</strong></p>
                        @foreach($investor->preferred_industries as $industry)
                            <span class="badge bg-secondary me-1">{{ $industry }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Investitsiyalar tarixi</h5>
            </div>
            <div class="card-body">
                @forelse($investor->investments as $investment)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $investment->startup->name }}</strong><br>
                        <small class="text-muted">${{ number_format($investment->amount, 2) }}</small>
                        <span class="badge bg-{{ $investment->status == 'approved' ? 'success' : ($investment->status == 'rejected' ? 'danger' : 'warning') }} ms-2">
                            {{ ucfirst($investment->status) }}
                        </span>
                        <br>
                        <small class="text-muted">{{ $investment->created_at->format('d.m.Y') }}</small>
                    </div>
                @empty
                    <p class="text-muted">Hech qanday investitsiya yo'q</p>
                @endforelse
            </div>
        </div>

        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('investors.edit', $investor) }}" class="btn btn-primary">Tahrirlash</a>
            <a href="{{ route('investors.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>
</div>
@endsection