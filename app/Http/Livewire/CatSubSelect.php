<?php

namespace App\Http\Livewire;

use App\Models\Cat;
use App\Models\Sub;
use Livewire\Component;

class CatSubSelect extends Component
{
    public $cat_id = -1;
public $category;
public $subb;

    public function mount($category, $sub)
    {
        $this->cat_id = $category;
        $this->subb = $sub;
    }
    public function render()
    {

        $cats = Cat::all();
        $subs = Sub::select('id', 'name','cat_id')->where('status', 1)->get();

        return view('livewire.cat_sub_select', compact('subs', 'cats'));
    }
}
