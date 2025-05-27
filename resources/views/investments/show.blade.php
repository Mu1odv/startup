@extends('layouts.app')

@section('title', 'Investitsiya tafsilotlari')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Investitsiya tafsilotlari</h4>
                <span class="badge bg-{{ $investment->status == 'approved' ? 'success' : ($investment->status == 'rejected' ? 'danger' : 'warning') }} fs-6">
                    {{ ucfirst($investment->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Startap ma'lumotlari</h5>
                        <p><strong>Nomi:</strong> 
                            <a href="{{ route('startups.show', $investment->startup) }}">{{ $investment->startup->name }}</a>
                        </p>
                        <p><strong>Soha:</strong> {{ $investment->startup->industry }}</p>
                        <p><strong>Asoschisi:</strong> {{ $investment->startup->founder_name }}</p>
                        <p><strong>Maqsad:</strong> ${{ number_format($investment->startup->funding_goal, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Investor ma'lumotlari</h5>
                        <p><strong>Nomi:</strong> 
                            <a href="{{ route('investors.show', $investment->investor) }}">{{ $investment->investor->name }}</a>
                        </p>
                        <p><strong>Email:</strong> {{ $investment->investor->email }}</p>
                        <p><strong>Turi:</strong> {{ ucfirst($investment->investor->investor_type) }}</p>
                        <p><strong>Byudjet:</strong> ${{ number_format($investment->investor->total_budget, 2) }}</p>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>Investitsiya ma'lumotlari</h5>
                        <p><strong>Miqdor:</strong> ${{ number_format($investment->amount, 2) }}</p>
                        <p><strong>Sana:</strong> {{ $investment->created_at->format('d.m.Y H:i') }}</p>
                        @if($investment->notes)
                            <p><strong>Izohlar:</strong></p>
                            <p class="bg-light p-3 rounded">{{ $investment->notes }}</p>
                        @endif
                    </div>
                </div>

                @if($investment->status == 'pending')
                    <div class="d-flex gap-2 mb-3">
                        <form action="{{ route('investments.approve', $investment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Bu investitsiyani tasdiqlaysizmi?')">
                                Tasdiqlash
                            </button>
                        </form>
                        <form action="{{ route('investments.reject', $investment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bu investitsiyani rad etasizmi?')">
                                Rad etish
                            </button>
                        </form>
                    </div>
                @endif

                <div class="d-flex justify-content-between">
                    <a href="{{ route('investments.index') }}" class="btn btn-secondary">Orqaga</a>
                    @if($investment->status == 'pending')
                        <form action="{{ route('investments.destroy', $investment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Bu investitsiyani o\'chirasizmi?')">
                                O'chirish
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection