<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Startup;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with(['startup', 'investor'])->latest()->paginate(10);
        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        $startups = Startup::where('status', 'active')->get();
        $investors = Investor::all();
        return view('investments.create', compact('startups', 'investors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'startup_id' => 'required|exists:startups,id',
            'investor_id' => 'required|exists:investors,id',
            'amount' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
        ]);

        Investment::create($validated);
        return redirect()->route('investments.index')->with('success', 'Investitsiya yaratildi!');
    }

    public function show(Investment $investment)
    {
        $investment->load(['startup', 'investor']);
        return view('investments.show', compact('investment'));
    }

    public function approve(Investment $investment)
    {
        $investment->update(['status' => 'approved']);

        $startup = $investment->startup;
        $startup->current_funding += $investment->amount;
        $startup->save();

        return redirect()->back()->with('success', 'Investitsiya tasdiqlandi!');
    }

    public function reject(Investment $investment)
    {
        $investment->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Investitsiya rad etildi!');
    }

    public function destroy(Investment $investment)
    {
        $investment->delete();
        return redirect()->route('investments.index')->with('success', 'Investitsiya o\'chirildi!');
    }
}
