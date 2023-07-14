<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifCriteria;
use App\Models\Criteria;
use Illuminate\Http\Request;

class AlternatifValueController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::get();
        $criterias = Criteria::get();
        $alternatif_criterias = AlternatifCriteria::get();

        return view('alternatif_value.index', compact('alternatifs','criterias','alternatif_criterias'));
    }

    public function edit(AlternatifCriteria $alternatif_criteria)
    {
        $criterias = Criteria::get();
        return view('alternatif_value.edit', compact('alternatif_criteria','criterias'));
    }

    public function update(Request $request, AlternatifCriteria $alternatif_criteria)
    {
        foreach($request->except(['_token','_method']) as $data => $value){
            $valids[$data] = ['required','integer','min:1'];
        }

        $validated = $request->validate($valids);

        try {

            $alternatif_criteria->update($validated);

            return redirect()->route('alternatif.values.index')->with('message',['text' => 'Data nilai alternatif berhasil diubah.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('alternatif.values.index')->with('message',['text' => $th->getMessage(), 'class' => 'success']);
        }
    }

}
