@extends('layouts.app')

@section('title', $startup->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>{{ $startup->name }}</h4>
                <span class="badge bg-{{ $startup->status == 'active' ? 'success' : ($startup->status == 'funded' ? 'primary' : 'secondary') }} fs-6">
                    {{ ucfirst($startup->status) }}
                </span>
            </div>
            <div class="card-body">
                <p><strong>Tavsif:</strong></p>
                <p>{{ $startup->description }}</p>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Soha:</strong> {{ $startup->industry }}</p>
                        <p><strong>Asoschisi:</strong> {{ $startup->founder_name }}</p>
                        <p><strong>Email:</strong> {{ $startup->founder_email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Maqsadli moliya:</strong> ${{ number_format($startup->funding_goal, 2) }}</p>
                        <p><strong>Joriy moliya:</strong> ${{ number_format($startup->current_funding, 2) }}</p>
                        <p><strong>Muddat:</strong> {{ $startup->deadline->format('d.m.Y') }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Molialanish jarayoni:</strong></label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $startup->funding_percentage }}%">
                            {{ round($startup->funding_percentage, 1) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Investitsiyalar</h5>
            </div>
            <div class="card-body">
                @forelse($startup->investments as $investment)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $investment->investor->name }}</strong><br>
                        <small class="text-muted">${{ number_format($investment->amount, 2) }}</small>
                        <span class="badge bg-{{ $investment->status == 'approved' ? 'success' : ($investment->status == 'rejected' ? 'danger' : 'warning') }} ms-2">
                            {{ ucfirst($investment->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-muted">Hech qanday investitsiya yo'q</p>
                @endforelse
            </div>
        </div>

        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('startups.edit', $startup) }}" class="btn btn-primary">Tahrirlash</a>
            <a href="{{ route('startups.index') }}" class="btn btn-secondary">Orqaga</a>
        </div>
    </div>
</div>
@endsection