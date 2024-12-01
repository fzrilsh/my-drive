<?php

namespace App\Livewire;

use App\Models\Repository;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.upload')]
class RepoDetai extends Component
{
    public $repo;
    public $code;

    public $path = '';
    public $breadcrumb = '/';
    public $files = [];
    public $folders = [];

    public function mount(string $code){
        $this->repo = Repository::query()->where('code', $code)->firstOrFail();
        $this->code = $code;
        $this->refreshData();
    }

    public function render()
    {
        return view('livewire.repo-detai');
    }

    public function refreshData(){
        $this->folders = $this->repo->Folders()->getQuery()->where('path', $this->path)->get()->sortBy([['name', 'asc']])->values();
        $this->files = $this->repo->Files()->getQuery()->where('path', $this->path)->get()->sortBy([['name', 'asc']])->values();
        $this->breadcrumb = collect(explode('/', $this->path))->map(function($v){
            $segment = explode('/', $this->path);
            return end($segment) === $v ? $v : "<a class='cursor-pointer hover:underline' wire:click=removePath('$v')>$v</a>";
        })->join(' / ');
    }

    public function setPath($path){
        $this->path .= "/$path";
        $this->refreshData();
    }

    public function restartPath(){
        $this->path = '';
        $this->refreshData();
    }

    public function removePath($path){
        $this->path = '/' . $path;
        $this->refreshData();
    }
}
