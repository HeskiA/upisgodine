<?php

namespace App\Http\Controllers;

use App\Models\Predmet;
use Illuminate\Http\Request;

class PredmetController extends Controller
{
    /**
     * Display a listing of the predmets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $predmets = Predmet::all();

        return view('predmets.index', compact('predmets'));
    }

    /**
     * Show the form for creating a new predmet.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $predmets = Predmet::all();
        return view('predmets.create', compact('predmets'));
    }

    /**
     * Store a newly created predmet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string',
            'kapacitet' => 'required|integer',
        ]);

        Predmet::create($request->all());

        return redirect()->route('predmets.index')->with('success', 'Predmet created successfully.');
    }

    /**
     * Show the form for editing the specified predmet.
     *
     * @param  \App\Models\Predmet  $predmet
     * @return \Illuminate\View\View
     */
    public function edit(Predmet $predmet)
    {
        return view('predmets.edit', compact('predmet'));
    }

    /**
     * Update the specified predmet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Predmet  $predmet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Predmet $predmet)
    {
        $request->validate([
            'naziv' => 'required|string',
            'kapacitet' => 'required|integer',
        ]);

        $predmet->update($request->all());

        return redirect()->route('predmets.index')->with('success', 'Predmet updated successfully.');
    }

    /**
     * Remove the specified predmet from storage.
     *
     * @param  \App\Models\Predmet  $predmet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Predmet $predmet)
    {
        $predmet->delete();

        return redirect()->route('admin-predmeti-moduli')->with('success', 'Predmet deleted successfully.');
    }
}
