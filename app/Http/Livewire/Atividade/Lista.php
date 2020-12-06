<?php

namespace App\Http\Livewire\Atividade;

use App\Http\Service\TokenService;
use App\Models\Atividade;
use App\Models\Constant;
use Livewire\Component;
use function Psy\debug;

class Lista extends Component
{
    public $atividades;
    public $displaying = false;
    public $ids = false;
    public function render()
    {
        $this->atividades =  Atividade::getAllActive();

        return view('livewire.atividade.lista');
    }

    public function setDelete($displaying, $ids)
    {
        $this->displaying = $displaying;
        $this->ids = $ids;
        $this->emit('reloadGridEvent');
    }

    public function delete()
    {
        $activity = Atividade::find(TokenService::tokenizer($this->ids)->id);
        $activity->flg_situacao = Constant::FLG_INATIVO;
        $activity->save();
        $this->displaying = !$this->displaying;
        session()->flash('message', __('Atividade excluida com sucesso!'));
        $this->emitTo('componente.message','infosEvent',
            ['title' => 'Aviso','msg' => __('Atividade excluida com sucesso!')]);
        redirect()->to('/adm/atividades');

    }

    public function closeModal()
    {
        $this->displaying = !$this->displaying;
        $this->emit('reloadGridEvent');
    }
}
