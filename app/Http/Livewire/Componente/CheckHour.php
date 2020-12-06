<?php

namespace App\Http\Livewire\Componente;

use Livewire\Component;

class CheckHour extends Component
{
    public $dia;
    public $i;
    public $dias=[];

    protected $listeners = ['clearDiasEvent'=>'clear'];
    public function render()
    {
        return view('livewire.componente.check-hour');
    }


    public function updatedDias()
    {
        $this->emit('addCheck', $this->dias);
    }

    public function clear()
    {
        $this->dias=[];
    }
}
