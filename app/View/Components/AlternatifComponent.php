<?php

namespace App\View\Components;

use App\Models\Alternatif;
use Illuminate\View\Component;

class AlternatifComponent extends Component
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
        $count_alternatif = Alternatif::where('user_id', auth()->id())->count();
        return view('components.alternatif-component', compact('count_alternatif'));
    }
}
