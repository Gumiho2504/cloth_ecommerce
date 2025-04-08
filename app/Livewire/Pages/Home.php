<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Url;


use Livewire\WithPagination;

#[layout('layouts.app')]
class Home extends Component
{
    use WithPagination;
    // public CartItemService $cartItemService;
    public $size;

    public $search;

    #[Url()]
    public $filters;

    public $category;

    public $maxPrice;
    public $minPrice;
    public $color;

    public $results = [];
    // public $products = [];


    public function mount() {}


    public function render()
    {


        $this->filters = [
            "search" => $this->search,
            "size" => $this->size,
            "category" => $this->category,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'color' => $this->color
        ];
        if (strlen($this->search) >= 2) {
            $this->results = \App\Models\Product::where('name', 'like', '%' . $this->search . '%')->get();
        }

        $products = \App\Models\Product::filter($this->filters)->paginate(8);
        return view(
            'livewire.pages.home',
        )->with('products', $products);
    }
}
