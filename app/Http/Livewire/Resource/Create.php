<?php

namespace App\Http\Livewire\Resource;


use App\Http\Livewire\Componente\CheckHour;
use App\Http\Service\AgendaService;
use App\Http\Service\TokenService;
use App\Models\Agenda;
use App\Models\Atividade;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\Resource;
use App\Models\SemanaPeriodo;
use App\Models\TypeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
{


    protected $rules = [];
    protected $listeners = [];

    public $isSaved = false;
    public $isEdit = false;
    public $resource = [];
    public $types = [];
    public $typeId;
    public $msg;


    public function mount(Request $request)
    {
        $this->populateEdit($request);
    }

    public function render()
    {
        $this->types = TypeResource::all()->where("flg_sit", Constant::FLG_ATIVO);
        return view('livewire.resource.create');
    }

    public function save()
    {
        Validator::make($this->resource, [
            'str_name' => ['required', 'string', 'max:255'],
            'type_resource_id' => ['required'],
        ])->validate();
        if(!$this->isEdit)
        {
            $resource = Resource::create($this->resource);
            $this->isSaved = true;
            $this->resource = [];
            $this->emitTo('componente.message','infosEvent',
                ['title' => 'Aviso','msg' => 'Recurso salvo com sucesso.']);
        }
        else
        {
            $result = Resource::find(TokenService::tokenizer($this->resource['id'])->id);
            $result->fill($this->resource);
            if($result->save())
            {
                $this->emit('hideLoadingEvent');
                $this->isSaved = true;
                $this->msg = "Recurso alterado com sucesso.";
                $this->atividade = [];
            }

        }
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    protected function populateEdit(Request $request): void
    {
        if (isset($request->id) && !empty($request->id)) {
            $this->resource = Resource::find(TokenService::tokenizer($request->id)->id)->toArray();
            $this->isEdit = true;
        }
    }


}
