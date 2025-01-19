<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Card;

class SearchCards extends Component
{
    public $search = '';
    public $cards = [];

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->cards = Card::where('card_name', 'like', '%' . $this->search . '%')
                ->orWhere('series', 'like', '%' . $this->search . '%')
                ->orWhere('rarity', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('set_code', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->cards = collect([]);
        }
    }

    public function render()
    {
        return view('livewire.search-cards');
    }
} 