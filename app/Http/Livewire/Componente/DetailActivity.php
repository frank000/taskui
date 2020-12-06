<?php

namespace App\Http\Livewire\Componente;

use Livewire\Component;

class DetailActivity extends Component
{
    public $atividade;
    public $resources;
    public $ids;
    public $isCreate = false;

    public function render()
    {
        return view('livewire.componente.detail-activity');
    }
}
