@extends('layouts.app')

@section('title', 'Investitsiyalar ro\'yxati')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Investitsiyalar</h1>
    <a href="{{ route('investments.create') }}" class="btn btn-primary">Yangi Investitsiya</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Startap</th>
                <th>Investor</th>
                <th>Miqdor</th>
                <th>Status</th>
                <th>Sana</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($investments as $investment)
                <tr>
                    <td>{{ $investment->startup->name }}</td>
                    <td>{{ $investment->investor->name }}</td>
                    <td>${{ number_format($investment->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $investment->status == 'approved' ? 'success' : ($investment->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($investment->status) }}
                        </span>
                    </td>
                    <td>{{ $investment->created_at->format('d.m.Y') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('investments.show', $investment) }}" class="btn btn-outline-primary">Ko'rish</a>
                            @if($investment->status == 'pending')
                                <form action="{{ route('investments.approve', $investment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-success">Tasdiqlash</button>
                                </form>
                                <form action="{{ route('investments.reject', $investment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-danger">Rad etish</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Hech qanday investitsiya topilmadi. <a href="{{ route('investments.create') }}">Yangi investitsiya yarating</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $investments->links() }}
@endsection