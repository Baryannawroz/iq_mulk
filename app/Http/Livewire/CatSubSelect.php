<?php

namespace App\Http\Livewire;

use App\Models\Cat;
use App\Models\Sub;
use Livewire\Component;

class CatSubSelect extends Component
{
    public $cat_id = -1;

    public function render()
    {
        $cats = Cat::all();
        $subs = Sub::all();
        return view('livewire.cat_sub_select', compact('subs', 'cats'));
    }
}