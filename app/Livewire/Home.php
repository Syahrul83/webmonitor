<?php

namespace App\Livewire;

use App\Models\WebDate;
use Livewire\Component;

class Home extends Component
{
    public $posts;
    public $search;

    public function mount($search = null)
    {
        if($search != null) {
            $this->posts = WebDate::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->posts = WebDate::all();

        }

    }

    public function render()
    {
        return view('livewire.home');
    }
}
