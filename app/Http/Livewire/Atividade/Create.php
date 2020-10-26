<?php

namespace App\Http\Livewire\Atividade;


use App\Http\Livewire\Componente\CheckHour;
use App\Http\Service\AgendaService;
use App\Models\Agenda;
use App\Models\Atividade;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\Resource;
use App\Models\SemanaPeriodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use phpDocumentor\Reflection\Utils;

class Create extends Component
{
    public $atividade = [];
    public $i = 0;
    public $isSaved = false;
    public $custonOpen = false;
    public $msg;
    public $arrDias = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
    public $dias=[];

    //variables next page
    public $pageScreen = 2;
    public $isFirstPage = true;
    public $isSecondPage = false;
    public $resourceObj;
    public $resources;
    public $resourcesArr=[];

    protected $rules = [];

    protected $listeners = ['addCheck' => 'setValues',
                            'deleteResourceEvent'=>'deleteResource'];

    public function render()
    {
        $this->resources = Resource::all();
        return view('livewire.atividade.create');
    }

    public function save()
    {
        Validator::make($this->atividade, [
            'str_atividade' => ['required', 'string', 'max:255'],
            'str_desc' => ['required', 'string', 'max:255'],
            'dat_inicio' => ['required'],
            'dat_fim' => ['required', 'string', 'max:255'],
        ])->validate();

        $this->atividade['flg_situacao']  = 'A';
        $this->atividade['user_id']  = Auth::user()->id;

        if($atividade = Atividade::create($this->atividade))
        {
           if($this->organizaDias($atividade->id))
           {
                $agenda = new AgendaService(new Agenda());
                try{
                    $agenda->gerarAgenda($atividade);
                    $this->isSaved = true;
                    $this->msg = "Registro salvo com sucesso.";
                    $this->atividade = [];
                }catch (\Exception $e){
                    $this->isSaved = false;
                    $this->msg = "Houve um problema ao criar a atividade.";
                    $this->atividade = [];
                }

           }
        }
    }

    /**
     * Monta o array de dias para valores personalisados
     * @param array $value
     */
    public function setValues(Array $value)
    {
        $this->dias[key($value)] = $value;
        if(!$value[key($value)])
            unset($this->dias[key($value)]);
    }

    public function organizaDias($id)
    {
        //salva 7 dias semana
        if(isset($this->dias['all']))
        {
            Validator::make($this->dias, [
                'hor_inicio_man' => ['required',  'max:255'],
                'hor_fim_man' => ['required',  'max:255'],
                'hor_inicio_man' => ['required',  'max:255'],
                'hor_fim_man' => ['required',  'max:255'],
            ])->validate();

            for ($dia = 0 ; $dia < 7; $dia++ )
            {
                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['resource_id'] = $dia;
                $arrDia['num_dia'] = $dia;
                $arrDia['hor_inicio_man'] = $this->dias['hor_inicio_man'];
                $arrDia['hor_fim_man'] = $this->dias['hor_fim_man'];
                $arrDia['hor_inicio_tar'] = $this->dias['hor_inicio_tar'];
                $arrDia['hor_fim_man_tar'] = $this->dias['hor_fim_tar'];
                $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                SemanaPeriodo::create($arrDia);
            }
            return true;
        }
        elseif (isset($this->dias['uteis']))
        {
            Validator::make($this->dias, [
                'hor_inicio_man' => ['required',  'max:255'],
                'hor_fim_man' => ['required',  'max:255'],
                'hor_inicio_man' => ['required',  'max:255'],
                'hor_fim_man' => ['required',  'max:255'],
            ])->validate();
            for ($dia = 1 ; $dia < 6; $dia++ )
            {
                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['num_dia'] = $dia;
                $arrDia['hor_inicio_man'] = $this->dias['hor_inicio_man'];
                $arrDia['hor_fim_man'] = $this->dias['hor_fim_man'];
                $arrDia['hor_inicio_tar'] = $this->dias['hor_inicio_tar'];
                $arrDia['hor_fim_man_tar'] = $this->dias['hor_fim_tar'];
                $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                SemanaPeriodo::create($arrDia);
            }
            return true;
        }
        else
        {
            $arrDias = [];
            foreach ($this->dias as $dia)
            {
                Validator::make($dia, [
                    'hor_inicio_man_p' => 'required',
                    'hor_fim_man_p' => 'required',
                    'hor_inicio_tar_p' => 'required',
                    'hor_fim_tar_p' => 'required',
                ])->validate();

                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['num_dia'] = Constant::DIAS[key($dia)];
                $arrDia['hor_inicio_man'] = $this->dias['hor_inicio_man_p'];
                $arrDia['hor_fim_man'] = $this->dias['hor_fim_man_p'];
                $arrDia['hor_inicio_tar'] = $this->dias['hor_inicio_tar_p'];
                $arrDia['hor_fim_man_tar'] = $this->dias['hor_fim_tar_p'];
                $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                array_push($arrDias,$arrDia);
            }
            foreach ($arrDias as $data)
            {
                SemanaPeriodo::create($data);
            }
            return true;
        }




    }

    /**
     * Evento que muda visualização de intens de hora e dias
     *
     */
    public function showPersonalizar()
    {
        $this->dias = [];
        $this->custonOpen = !$this->custonOpen;

    }

    public function getPageProperty()
    {
        if($this->isFirstPage)
            return 1;

        if($this->isSecondPage)
            return 2;
    }

    public function changePage($page)
    {//&& is_array($this->validatePage())
        if($page == 1 )
        {
            $this->pageScreen = 2;
        }else if($page == 2)
        {
            //verifica ser tem resource, se não tiver, mantem pagina, alerta para relacionar ao menos um recurso.
            if(count($this->resourcesArr) > 0)
            {
                $this->pageScreen = 3;
            }
            else
            {
                $this->emit('selectResourceEvent');
            }
        }

    }

    public function backPage($page)
    {
        $this->pageScreen = $page-1;
    }

    protected function validatePage()
    {
        return Validator::make($this->atividade, [
            'str_atividade' => ['required', 'string', 'max:255'],
            'str_desc' => ['required', 'string', 'max:255'],
            'dat_inicio' => ['required'],
            'dat_fim' => ['required', 'string', 'max:255'],
        ])->validate();
    }

    public function addResource()
    {

        Validator::make(['type_resource'=>$this->resourceObj], [
            'type_resource' => ['required']
        ])->validate();
        if($this->custonOpen)
        {
            $this->validateCustom();
        }
        else
        {
            $this->validateDefault();
        }

//
        $resourceObject =Resource::find($this->resourceObj);
        $this->resourcesArr[ $resourceObject->str_name] = array('dias' =>  $this->handleDays($this->dias),
            'resource' =>  $resourceObject->str_name,'id' =>  $resourceObject->id,
            'days' => $this->dias);
//
        $this->resourceObj = "";
        $this->dias=[];
        $this->emit('addedResourceEvent',$this->resourcesArr);
        $this->emitTo("CheckHour","clearDiasEvent");
    }

    protected function handleDays($arrDays)
    {
        $resultString = "";
        if(count($arrDays))
        {
            if(!empty($arrDays['all']) && $arrDays['all'] || !empty($arrDays['uteis']) && $arrDays['uteis'])
            {
                $resultString .= " - " . $arrDays['hor_inicio_man'] . " ás " . $arrDays['hor_fim_man'] . " e ";
                $resultString .= $arrDays['hor_inicio_tar'] . " ás " . $arrDays['hor_fim_tar'];

                $resultString .= (!empty($arrDays['all']) && $arrDays['all'] )? ' - Todos os dias' : ' - Dias uteis' ;
            }
            else
            {
                foreach ($arrDays as $key =>$day)
                {
                    $resultString .= " | " . Constant::COMPLETE_DAYS[$key];
                }
            }
        }
        return $resultString;
    }

    protected function validateCustom()
    {
        if(count($this->dias)>0)
        {
            foreach (array_keys(Constant::DIAS) as $day)
            {
                if(isset($this->dias[$day]))
                {
                    if(!isset($this->dias[$day]['hor_inicio_man_p']) || !isset($this->dias[$day]['hor_fim_man_p'])
                        || !isset($this->dias[$day]['hor_inicio_tar_p']) || !isset($this->dias[$day]['hor_fim_tar_p']))
                    {
                        Validator::make(['erroInput_'.$day=>''], [
                            'erroInput_'.$day => ['required']
                        ])->validate();
                    }

                }
            }
        }

    }

    protected function validateDefault()
    {
        if((!empty($this->dias) && count($this->dias) > 0) &&
            (!empty($this->dias['all']) || !empty($this->dias['uteis'])))
        {

        }
        else
        {
            Validator::make(['all'=>''], [
                'all' => ['required']
            ])->validate();
        }
        if(empty($this->dias['hor_inicio_man']) || empty($this->dias['hor_fim_man'])
            ||empty($this->dias['hor_inicio_tar']) || empty($this->dias['hor_fim_tar']))
        {
            Validator::make(['hor_inicio_man'=>''], [
                'hor_inicio_man' => ['required']
            ])->validate();
        }
    }
    public function deleteResource($val)
    {
        unset($this->resourcesArr[$val['resource']]);
        $this->emit('addedResourceEvent',$this->resourcesArr);
    }

    public function updatedResourceObj()
    {
        $this->emitTo("CheckHour","clearDiasEvent");
    }
}
