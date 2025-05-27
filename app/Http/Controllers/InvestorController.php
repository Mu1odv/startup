<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        $investors = Investor::latest()->paginate(10);
        return view('investors.index', compact('investors'));
    }

    public function create()
    {
        return view('investors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors,email',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'total_budget' => 'required|numeric|min:1',
            'investor_type' => 'required|in:individual,company,fund',
        ]);

        Investor::create($validated);
        return redirect()->route('investors.index')->with('success', 'Investor yaratildi!');
    }

    public function show(Investor $investor)
    {
        $investor->load('investments.startup');
        return view('investors.show', compact('investor'));
    }

    public function edit(Investor $investor)
    {
        return view('investors.edit', compact('investor'));
    }

    public function update(Request $request, Investor $investor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors,email,' . $investor->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'total_budget' => 'required|numeric|min:1',
            'investor_type' => 'required|in:individual,company,fund',
        ]);

        $investor->update($validated);
        return redirect()->route('investors.index')->with('success', 'Investor yangilandi!');
    }

    public function destroy(Investor $investor)
    {
        $investor->delete();
        return redirect()->route('investors.index')->with('success', 'Investor o\'chirildi!');
    }
}
