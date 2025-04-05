<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Url;

#[layout('layouts.guest')]
class Productshow extends Component
{
    public $product;

    public $color;
    public $size;
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <h1>Loding--</h1>
        </div>
        HTML;
    }
    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
    }

    #[Url()]
    public function render()
    {

        return view('livewire.products.productshow')->with('product', $this->product);
    }
}
