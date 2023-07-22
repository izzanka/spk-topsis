<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCriteriaController extends Controller
{
    public function index()
    {
        $count_criteria = Criteria::where('user_id', auth()->id())->count();

        if($count_criteria == 0)
        {
            return redirect()->route('criterias.index')->with('message',['text' => 'Harap masukkan data kriteria terlebih dahulu.', 'class' => 'warning']);
        }

        $sub_criterias = SubCriteria::where('user_id', auth()->id())->latest()->paginate(15);
        return view('sub_criteria.index', compact('sub_criterias'));
    }

    public function create()
    {
        $criterias = Criteria::where('user_id', auth()->id())->get();
        return view('sub_criteria.create', compact('criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_id' => ['required', 'integer'],
            'name' => ['required', 'max:100'],
            'value' => ['required','integer','min:1','max:5'],
        ]);

        try {

            $sub_criterias = SubCriteria::where('user_id', auth()->id())->where('criteria_id', $request->criteria_id)->get();

            if($sub_criterias->count() == 5)
            {
                return back()->with('message',['text' => 'Sub kriteria sudah berjumlah 5.', 'class' => 'warning']);
            }

            if($sub_criterias->contains('value', $request->value))
            {
                return back()->with('message',['text' => 'Sub kriteria dengan nilai ' . $request->value . ' sudah dibuat!', 'class' => 'danger']);
            }

            SubCriteria::create([
                'user_id' => auth()->id(),
                'criteria_id' => $request->criteria_id,
                'name' => $request->name,
                'value' => $request->value,
            ]);

            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria berhasil disimpan.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria gagal disimpan.', 'class' => 'danger']);
        }
    }

    public function edit(SubCriteria $sub_criteria)
    {
        if($sub_criteria->user_id != auth()->id())
        {
            return back();
        }

        $criterias = Criteria::where('user_id', auth()->id())->get();
        return view('sub_criteria.edit', compact('sub_criteria','criterias'));
    }

    public function update(Request $request, SubCriteria $sub_criteria)
    {
        if($sub_criteria->user_id != auth()->id())
        {
            return back();
        }

        $validated = $request->validate([
            'name' => ['required', 'max:100'],
            'value' => ['required','integer','min:1','max:5'],
        ]);

        try {

            $sub_criteria->update($validated);

            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria berhasil diubah.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria gagal diubah', 'class' => 'danger']);
        }
    }

    public function destroy(SubCriteria $sub_criteria)
    {
        if($sub_criteria->user_id != auth()->id())
        {
            return back();
        }

        try {

            $sub_criteria->delete();

            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria berhasil dihapus.', 'class' => 'success']);

        } catch (\Throwable $th) {
            return redirect()->route('sub_criterias.index')->with('message',['text' => 'Data sub kriteria gagal dihapus', 'class' => 'danger']);
        }
    }
}
