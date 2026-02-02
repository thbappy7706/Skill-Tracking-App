<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('SkillUpx - Track Your Journey to Mastery')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.landing');
    }
}
