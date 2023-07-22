<?php

namespace App\View\Components;

use App\Models\Criteria;
use Illuminate\View\Component;

class CriteriaComponent extends Component
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
        $count_criteria = Criteria::where('user_id', auth()->id())->count();
        return view('components.criteria-component', compact('count_criteria'));
    }
}
