<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Productshow extends Component
{
    public $product;
    #[Url()]
    public int $color_id;
    #[Url()]
    public int $size_id;
    public $stockByColor;

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
        $this->color_id = $this->product->colors()->first()->id;
        $this->size_id = $this->product->sizes()->first()->id;
        // dump([$this->color_id, $this->size_id]);
    }


    public function render()
    {

        $variation = $this->product->variations()->where('color_id', $this->color_id)->where('size_id', $this->size_id)->first();
        $this->stockByColor = $variation->stock;
        return view('livewire.products.productshow')->with('product', $this->product);
    }

    public function selectSize(int $id)
    {

        $this->size_id = $id;
    }

    public function selectColor(int $id)
    {

        $this->color_id = $id;
    }


    public function test()
    {
        dd("test");
    }
}
