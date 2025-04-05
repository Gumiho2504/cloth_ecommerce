<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Home extends Component
{

    public $size;

    public $search;

    #[Url()]
    public $filters;

    public $category;

    public $results = [];
    public $products = [];


    public function render()
    {

        $this->filters = [
            "search" => $this->search,
            "size" => $this->size,
            "category" => $this->category
        ];
        if (strlen($this->search) >= 2) {
            $this->results = \App\Models\Product::where('name', 'like', '%' . $this->search . '%')->get();
        }

        $this->products = \App\Models\Product::filter($this->filters)->get();

        return view(
            'livewire.pages.home'
        );
    }
}
