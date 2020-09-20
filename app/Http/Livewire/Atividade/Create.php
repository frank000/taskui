<?php

namespace App\Http\Livewire\Atividade;


use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
{
    public $atividade = [];

    public function render()
    {
        return view('adm.atividade.create');
    }

    public function save()
    {
        return Validator::make($this->atividade, [
            'str_ativiade' => ['required', 'string', 'max:255'],
            'str_desc' => ['required', 'string', 'max:255'],
        ])->validate();
        ;
        //dd($this->atividade);
    }
}
