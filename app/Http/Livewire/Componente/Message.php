<?php

namespace App\Http\Livewire\Componente;

use Livewire\Component;

class Message extends Component
{
    public $show = false;
    public $title = 'false';
    public $msg = 'false';

    protected $listeners = ['infosEvent' => 'show'];

    public function render()
    {
        return view('livewire.componente.message');
    }
    public function show($event)
    {
        $this->msg = $event['msg'];
        $this->title = $event['title'];

        $this->show = true;
        $this->emit("showEvent");
    }


}
