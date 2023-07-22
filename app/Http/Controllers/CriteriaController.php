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
        $criterias = Criteria::where('user_id', auth()->id())->paginate(15);
        return view('criteria.index', compact('criterias'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required','string','max:5','min:1','unique:criterias,code'],
            'name' => ['required','string','max:60','unique:criterias,name'],
            'attribute' => ['required','string'],
            'weight' => ['required','integer','min:1'],
        ]);

        try {

            Criteria::create([
                'user_id' => auth()->id(),
                'code' => $request->code,
                'name' => $request->name,
                'attribute' => $request->attribute,
                'weight' => $request->weight,
            ]);

            $fieldName = Str::slug($request->name, '_');

            Schema::table($this->table_name, function(Blueprint $table) use ($fieldName){
                $table->string($fieldName)->default(0);
            });

            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria berhasil disimpan.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria gagal disimpan', 'class' => 'danger']);
        }
    }

    public function edit(Criteria $criteria)
    {
        if($criteria->user_id != auth()->id())
        {
            return back();
        }

        $attributes = collect(['Cost','Profit']);
        return view('criteria.edit', compact('criteria','attributes'));
    }

    public function update(Request $request, Criteria $criteria)
    {
        if($criteria->user_id != auth()->id())
        {
            return back();
        }

        $validated = $request->validate([
            'name' => ['required','string','max:60', Rule::unique('criterias')->ignore($criteria->id)],
            'attribute' => ['required','string'],
            'weight' => ['required','integer','min:1'],
        ]);

        try {

            $oldFieldName = Str::slug(strtolower($criteria->name), '_');
            $fieldName = Str::slug($validated['name'], '_');

            $criteria->update($validated);

            if($oldFieldName != $fieldName)
            {
                Schema::table($this->table_name, function(Blueprint $table) use ($oldFieldName, $fieldName){
                    $table->renameColumn($oldFieldName, $fieldName);
                });
            }

            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria berhasil diubah.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria gagal diubah', 'class' => 'danger']);
        }
    }

    public function destroy(Criteria $criteria)
    {
        if($criteria->user_id != auth()->id())
        {
            return back();
        }

        try {

            $fieldName = Str::slug(strtolower($criteria->name), '_');

            Schema::table($this->table_name, function(Blueprint $table) use ($fieldName){
                $table->dropColumn($fieldName);
            });

            $criteria->delete();

            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria berhasil dihapus.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('criterias.index')->with('message',['text' => 'Data kriteria gagal dihapus', 'class' => 'danger']);
        }
    }
}

