<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::get();
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required','string','max:5','min:1','unique:alternatifs,code'],
            'name' => ['required','string','max:25','unique:alternatifs,name']
        ]);

        Alternatif::create($validated);

        return redirect()->route('alternatifs.index');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:25', Rule::unique('alternatifs')->ignore($alternatif->id)]
        ]);

        $alternatif->update($validated);

        return redirect()->route('alternatifs.index');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('alternatifs.index');
    }
}

