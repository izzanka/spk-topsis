<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifCriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::where('user_id', auth()->id())->paginate(15);
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required','string','max:5','min:1','unique:alternatifs,code'],
            'name' => ['required','string','max:60','unique:alternatifs,name']
        ]);

        try {

            $alternatif = Alternatif::create([
                'user_id' => auth()->id(),
                'code' => $request->code,
                'name' => $request->name,
            ]);

            AlternatifCriteria::create([
                'user_id' => auth()->id(),
                'alternatif_id' => $alternatif->id,
            ]);

            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif berhasil disimpan.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif gagal disimpan', 'class' => 'danger']);
        }
    }

    public function edit(Alternatif $alternatif)
    {
        if($alternatif->user_id != auth()->id())
        {
            return back();
        }

        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        if($alternatif->user_id != auth()->id())
        {
            return back();
        }

        $validated = $request->validate([
            'name' => ['required','string','max:60', Rule::unique('alternatifs')->ignore($alternatif->id)]
        ]);

        try {

            $alternatif->update($validated);

            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif berhasil diubah.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif gagal diubah', 'class' => 'danger']);
        }
    }

    public function destroy(Alternatif $alternatif)
    {
        if($alternatif->user_id != auth()->id())
        {
            return back();
        }

        try {

            $alternatif->delete();

            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif berhasil dihapus.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('alternatifs.index')->with('message',['text' => 'Data alternatif gagal dihapus', 'class' => 'danger']);
        }
    }
}

