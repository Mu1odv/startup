<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    public function index()
    {
        $startups = Startup::latest()->paginate(10);
        return view('startups.index', compact('startups'));
    }

    public function create()
    {
        return view('startups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:255',
            'funding_goal' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today',
            'founder_name' => 'required|string|max:255',
            'founder_email' => 'required|email|max:255',
        ]);

        Startup::create($validated);
        return redirect()->route('startups.index')->with('success', 'Startup yaratildi!');
    }

    public function show(Startup $startup)
    {
        $startup->load('investments.investor');
        return view('startups.show', compact('startup'));
    }

    public function edit(Startup $startup)
    {
        return view('startups.edit', compact('startup'));
    }

    public function update(Request $request, Startup $startup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:255',
            'funding_goal' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today',
            'founder_name' => 'required|string|max:255',
            'founder_email' => 'required|email|max:255',
            'status' => 'required|in:draft,active,funded,closed',
        ]);

        $startup->update($validated);
        return redirect()->route('startups.index')->with('success', 'Startup yangilandi!');
    }

    public function destroy(Startup $startup)
    {
        $startup->delete();
        return redirect()->route('startups.index')->with('success', 'Startup o\'chirildi!');
    }
}
