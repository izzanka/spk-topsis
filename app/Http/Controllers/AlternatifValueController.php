<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifCriteria;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class AlternatifValueController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::where('user_id', auth()->id())->get();
        $criterias = Criteria::where('user_id', auth()->id())->get();
        $sub_criterias = SubCriteria::where('user_id', auth()->id())->get();
        $alternatif_criterias = AlternatifCriteria::where('user_id', auth()->id())->get();

        foreach($criterias as $criteria)
        {
            if(!$sub_criterias->contains('criteria_id',$criteria->id)){
                return redirect()->route('sub_criterias.index')->with('message',['text' => 'Harap membuat sub kriteria untuk semua kritera yang telah dibuat.', 'class' => 'warning']);
            }
        }

        return view('alternatif_value.index', compact('alternatifs','criterias','alternatif_criterias'));
    }

    public function edit(AlternatifCriteria $alternatif_criteria)
    {
        if($alternatif_criteria->user_id != auth()->id())
        {
            return back();
        }

        $sub_criterias = SubCriteria::where('user_id', auth()->id())->get();
        $criterias = Criteria::where('user_id', auth()->id())->get();
        return view('alternatif_value.edit', compact('alternatif_criteria','criterias', 'sub_criterias'));
    }

    public function update(Request $request, AlternatifCriteria $alternatif_criteria)
    {
        if($alternatif_criteria->user_id != auth()->id())
        {
            return back();
        }

        foreach($request->except(['_token','_method']) as $data => $value){
            $valids[$data] = ['required','numeric'];
            $valids[$data] = ['required','numeric','gt:0'];
        }

        $validated = $request->validate($valids);

        try {

            $alternatif_criteria->update($validated);

            return redirect()->route('alternatif.values.index')->with('message',['text' => 'Data nilai alternatif berhasil diubah.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('alternatif.values.index')->with('message',['text' => 'Data nilai alternatif gagal dihapus', 'class' => 'success']);
        }
    }

}
