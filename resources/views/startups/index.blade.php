@extends('layouts.app')

@section('title', 'Startaplar ro\'yxati')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Startaplar</h1>
    <a href="{{ route('startups.create') }}" class="btn btn-primary">Yangi Startap</a>
</div>

<div class="row">
    @forelse($startups as $startup)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $startup->name }}</h5>
                    <p class="card-text">{{ Str::limit($startup->description, 100) }}</p>
                    <p class="text-muted mb-2">
                        <strong>Soha:</strong> {{ $startup->industry }}<br>
                        <strong>Maqsad:</strong> ${{ number_format($startup->funding_goal, 2) }}<br>
                        <strong>Joriy:</strong> ${{ number_format($startup->current_funding, 2) }}<br>
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $startup->status == 'active' ? 'success' : ($startup->status == 'funded' ? 'primary' : 'secondary') }}">
                            {{ ucfirst($startup->status) }}
                        </span>
                    </p>
                    
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: {{ $startup->funding_percentage }}%">
                            {{ round($startup->funding_percentage, 1) }}%
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100">
                        <a href="{{ route('startups.show', $startup) }}" class="btn btn-outline-primary btn-sm">Ko'rish</a>
                        <a href="{{ route('startups.edit', $startup) }}" class="btn btn-outline-secondary btn-sm">Tahrirlash</a>
                        <form action="{{ route('startups.destroy', $startup) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Ishonchingiz komilmi?')">O'chirish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Hech qanday startap topilmadi. <a href="{{ route('startups.create') }}">Yangi startap yarating</a>
            </div>
        </div>
    @endforelse
</div>

{{ $startups->links() }}
@endsection