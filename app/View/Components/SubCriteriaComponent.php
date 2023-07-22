<?php

namespace App\View\Components;

use App\Models\SubCriteria;
use Illuminate\View\Component;

class SubCriteriaComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $count_sub_criteria = SubCriteria::where('user_id', auth()->id())->count();
        return view('components.sub-criteria-component', compact('count_sub_criteria'));
    }
}
