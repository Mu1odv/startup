@extends('layouts.app')

@section('title', 'Investorlar ro\'yxati')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Investorlar</h1>
    <a href="{{ route('investors.create') }}" class="btn btn-primary">Yangi Investor</a>
</div>

<div class="row">
    @forelse($investors as $investor)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $investor->name }}</h5>
                    <p class="card-text">{{ Str::limit($investor->bio, 100) }}</p>
                    <p class="text-muted mb-2">
                        <strong>Email:</strong> {{ $investor->email }}<br>
                        @if($investor->phone)
                            <strong>Telefon:</strong> {{ $investor->phone }}<br>
                        @endif
                        <strong>Byudjet:</strong> ${{ number_format($investor->total_budget, 2) }}<br>
                        <strong>Turi:</strong> 
                        <span class="badge bg-info">{{ ucfirst($investor->investor_type) }}</span>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="btn-group w-100">
                        <a href="{{ route('investors.show', $investor) }}" class="btn btn-outline-primary btn-sm">Ko'rish</a>
                        <a href="{{ route('investors.edit', $investor) }}" class="btn btn-outline-secondary btn-sm">Tahrirlash</a>
                        <form action="{{ route('investors.destroy', $investor) }}" method="POST" class="d-inline">
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
                Hech qanday investor topilmadi. <a href="{{ route('investors.create') }}">Yangi investor yarating</a>
            </div>
        </div>
    @endforelse
</div>

{{ $investors->links() }}
@endsection