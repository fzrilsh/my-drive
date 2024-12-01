<?php

namespace App\Livewire;

use App\Models\Repository;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard - My Drive')]
class Dashboard extends Component
{
    public $repositories = [];

    public $sortBy = 'name';
    public $groupBy = 'category';
    public $search = '';

    public function mount(){
        $this->repositories = Repository::all()->groupBy($this->groupBy)->map(fn($v) => $v->sortBy([[$this->sortBy, 'asc']])->values())->sortKeys(SORT_ASC);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function updated(){
        $this->repositories = Repository::query()
            ->where('name', 'LIKE', "%{$this->search}%")->get()
            ->groupBy($this->groupBy)
            ->sortKeys(SORT_ASC)
            ->map(fn($v) => $v->sortBy([[$this->sortBy, 'asc']])->values());
    }
}
