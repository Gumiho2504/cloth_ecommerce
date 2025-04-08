<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.app')]
class Contact extends Component
{
    public function render()
    {

        return view('livewire.pages.contact');
    }
}
