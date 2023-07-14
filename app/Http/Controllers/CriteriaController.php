<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifCriteria;
use App\Models\Criteria;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    private $table_name = 'alternatif_criterias';

    public function index()
    {
        $criterias = Criteria::get();
        return view('criteria.index', compact('criterias'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required','string','max:5','min:1','unique:criterias,code'],
            'name' => ['required','string','max:25','unique:criterias,name'],
            'attribute' => ['required','string'],
            'weight' => ['required','integer','min:1'],
        ]);

        Criteria::create($validated);

        $fieldName = Str::slug($validated['name'], '_');

        Schema::table($this->table_name, function(Blueprint $table) use ($fieldName){
            $table->integer($fieldName)->default(0);
        });

        $alternatifs = Alternatif::get();
        $alternatif_criterias = AlternatifCriteria::get();

        // foreach($alternatifs as $alternatif)
        // {
        //     if($alternatif_criterias->contains($alternatif->id)){

        //     }else{

        //         AlternatifCriteria::create([
        //             'alternatif_id' => $alternatif->id,
        //         ]);

        //     }
        // }

        return redirect()->route('criterias.index');
    }

    public function edit(Criteria $criteria)
    {
        $attributes = collect(['Cost','Profit']);
        return view('criteria.edit', compact('criteria','attributes'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:25', Rule::unique('criterias')->ignore($criteria->id)],
            'attribute' => ['required','string'],
            'weight' => ['required','integer','min:1'],
        ]);

        $criteria_name = strtolower($criteria->name);

        $oldFieldName = Str::slug($criteria_name, '_');
        $fieldName = Str::slug($validated['name'], '_');

        $criteria->update($validated);

        if($oldFieldName != $fieldName)
        {
            Schema::table($this->table_name, function(Blueprint $table) use ($oldFieldName, $fieldName){
                $table->renameColumn($oldFieldName, $fieldName);
            });
        }

        return redirect()->route('criterias.index');
    }

    public function destroy(Criteria $criteria)
    {
        $fieldName = strtolower($criteria->name);

        Schema::table($this->table_name, function(Blueprint $table) use ($fieldName){
            $table->dropColumn($fieldName);
        });

        $criteria->delete();

        return redirect()->route('criterias.index');
    }
}

