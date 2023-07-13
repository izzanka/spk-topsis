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

        // dd($alternatif_criterias);
        // $alternatif_values = [];

        // foreach($alternatifs as $index => $alternatif)
        // {
        //     array_push($alternatif_values, [$alternatif->id, $alternatif->code, $alternatif->name]);
        // }

        // foreach($alternatif_criterias as $ac)
        // {
        //     foreach($alternatif_values as $index => $value)
        //     {
        //         if($ac->alternatif->code == $value[1])
        //         {
        //             array_push($alternatif_values[$index], $ac->value);
        //         }
        //     }
        // }

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
        
        $alternatif_criteria->update($validated);

        return redirect()->route('alternatif.values.index');
    }

}
