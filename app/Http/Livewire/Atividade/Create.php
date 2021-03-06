<?php

namespace App\Http\Livewire\Atividade;


use App\Http\Livewire\Componente\CheckHour;
use App\Http\Service\AgendaService;
use App\Http\Service\TokenService;
use App\Models\Agenda;
use App\Models\Atividade;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\Resource;
use App\Models\SemanaPeriodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Http\Request;

class Create extends Component
{
    public $atividade = [];
    public $editable;
    public $i = 0;
    public $isSaved = false;
    public $custonOpen = false;
    public $msg;
    public $arrDias = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
    public $dias=[];

    //variables next page
    public $pageScreen = 1;
    public $isFirstPage = true;
    public $isSecondPage = false;
    public $resourceObj;
    public $resources;
    public $resourcesArr=[];

    protected $rules = [];

    protected $listeners = ['addCheck' => 'setValues',
                            'deleteResourceEvent'=>'deleteResource'];

    public function mount(Request $request)
    {
        $this->populateEdit($request);

    }
    public function render()
    {
        $this->resources = Resource::all();
        return view('livewire.atividade.create');
    }

    public function save()
    {
        try {
            Validator::make($this->atividade, [
                'str_atividade' => ['required', 'string', 'max:255'],
                'str_desc' => ['required', 'string', 'max:255'],
                'dat_inicio' => ['required'],
                'dat_fim' => ['required','date','after:dat_inicio'],
            ])->validate();

            $this->atividade['flg_situacao']  = 'A';
            $this->atividade['user_id']  = Auth::user()->id;

            if(isset($this->editable) && !empty($this->editable))
            {
                $atividade = Atividade::find(TokenService::tokenizer($this->editable)->id);
                $atividade->str_atividade = $this->atividade['str_atividade'];
                $atividade->str_desc = $this->atividade['str_desc'];
                $atividade->temp_periodo = $this->atividade['temp_periodo'];
                $atividade->dat_inicio = $this->atividade['dat_inicio'];
                $atividade->dat_fim = $this->atividade['dat_fim'];
                $atividade->save();
            }
            else
            {
                $atividade = Atividade::create($this->atividade);
            }

            $this->createActivity($atividade);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
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

    public function organizaDias($id, $resourceId, $resource)
    {
        $result = [];
        $days = [];
        if(isset($resource['days']))
        {
            $days = $resource['days'];
            //salva 7 dias semana
            if(isset($days['all']))
            {
                for ($dia = 0 ; $dia < 7; $dia++ )
                {
                    $arrDia = [];
                    $arrDia['atividade_id'] = $id;
                    $arrDia['resource_id'] = $resourceId;
                    $arrDia['num_dia'] = $dia;
                    $arrDia['hor_inicio_man'] = $days['hor_inicio_man'];
                    $arrDia['hor_fim_man'] = $days['hor_fim_man'];
                    $arrDia['hor_inicio_tar'] = $days['hor_inicio_tar'];
                    $arrDia['hor_fim_tar'] = $days['hor_fim_tar'];
                    $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                    $result[] = SemanaPeriodo::create($arrDia);
                }
                return $result;
            }
            elseif (isset($days['uteis']))
            {
                for ($dia = 1 ; $dia < 6; $dia++ )
                {
                    $arrDia = [];
                    $arrDia['atividade_id'] = $id;
                    $arrDia['resource_id'] = $resourceId;
                    $arrDia['num_dia'] = $dia;
                    $arrDia['hor_inicio_man'] = $days['hor_inicio_man'];
                    $arrDia['hor_fim_man'] = $days['hor_fim_man'];
                    $arrDia['hor_inicio_tar'] = $days['hor_inicio_tar'];
                    $arrDia['hor_fim_tar'] = $days['hor_fim_tar'];
                    $arrDia['flg_situacao'] = Constant::FLG_ATIVO;

                    $result[] = SemanaPeriodo::create($arrDia);
                }
                return $result;
            }
            else
            {
                $arrDias = [];
                foreach ($days as $dia)
                {
                    $arrDia = [];
                    $arrDia['atividade_id'] = $id;
                    $arrDia['resource_id'] = $resourceId;
                    $arrDia['num_dia'] = Constant::DIAS[key($dia)];
                    $arrDia['hor_inicio_man'] = $dia['hor_inicio_man_p'];
                    $arrDia['hor_fim_man'] = $dia['hor_fim_man_p'];
                    $arrDia['hor_inicio_tar'] = $dia['hor_inicio_tar_p'];
                    $arrDia['hor_fim_tar'] = $dia['hor_fim_tar_p'];
                    $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                    array_push($arrDias,$arrDia);
                }
                foreach ($arrDias as $data)
                {
                    $result[] = SemanaPeriodo::create($data);
                }
                return $result;
            }
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

    /**
     * Responsible to change page to the next
     * @param $page
     */
    public function changePage($page)
    {
        if($page == 1 )
        {
            $this->validatePage();
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

    /**
     * It's responsible to return a page in the screen
     * @param $page
     */
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
        $resourceObject = Resource::find($this->resourceObj);
        $this->resourcesArr[ $resourceObject->str_name] = array('dias' =>  $this->handleDays($this->dias),
            'resource' =>  $resourceObject->str_name,'id' =>  $resourceObject->id,
            'days' => $this->dias);
//
        $this->resourceObj = "";
        $this->dias=[];
        $this->emit('addedResourceEvent',$this->resourcesArr);
        $this->emitTo("CheckHour","clearDiasEvent");
    }

    /**
     * Create the string to de days field in the grid
     * @param $arrDays
     * @return string
     *
     */
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

    /**
     * Valida os campos de horários customizados
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * Valida o campo de horários padrões
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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

    /**
     * Deleta um recurso do array que é mostrado pelo componente inner resource
     * @param $val
     */
    public function deleteResource($val)
    {
        if(isset($this->resourcesArr[$val['resource']]))
        {
            unset($this->resourcesArr[$val['resource']]);
        }
        $this->emit('addedResourceEvent',$this->resourcesArr);
    }

    public function updatedResourceObj($val)
    {
        $this->resourceObj = $val;
        $this->dias = [];
        $this->emitTo("CheckHour","clearDiasEvent");
    }

    /**
     * Screen action, responsible to hide modal, and redirect page to back
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectPage()
    {
        $this->isSaved = !$this->isSaved;
        return redirect()->to('/adm/atividades');
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    protected function populateEdit(Request $request): void
    {
        if (isset($request->idactivity) && !empty($request->idactivity)) {
            $this->editable = $request->idactivity;
            $this->atividade = Atividade::find(TokenService::tokenizer($request->idactivity)->id)->toArray();
            //mount array of resources
            $id = (TokenService::tokenizer($request->idactivity)->id);
            $obj = Atividade::find($id);
            $arrs = $obj->semanaPeriodos->map(function ($item) {
                return array_merge($item->toArray(), $item->resource->toArray());
            });

            $resourcesArr = [];
            foreach ($arrs as $key => $row) {
                $result = [];
                $result['dias'] = " - " . Constant::COMPLETE_DAYS_INDEX[$row['num_dia']] . " de " . $row['hor_inicio_man'] . " às " . $row['hor_fim_man'] .
                    " - " . $row['hor_inicio_tar'] . " às " . $row['hor_fim_tar'];
                $result['resource'] = $row['str_name'];
                $result['id'] = TokenService::tokenizer($row['id'])->id;
                $resourcesArr[$key] = $result;
            }
            $this->resourcesArr = $resourcesArr;
        }
    }

    protected function createActivity($atividade): void
    {
        if ($atividade) {

            $agenda = new AgendaService(new Agenda());
            try {
                foreach ($this->resourcesArr as $resource)
                {
                    $result = $this->organizaDias($atividade->id, $resource['id'], $resource);
                    $agenda->gerarAgenda($atividade, $result, $resource['id']);
                }
                $this->emit('hideLoadingEvent');
                $this->isSaved = true;
                $this->msg = "Registro salvo com sucesso.";
                $this->atividade = [];
            } catch (\Exception $e) {
                $this->isSaved = true;
                $this->msg = "Houve um problema ao criar a atividade.";
                $this->msg .= $e->getMessage();
                $this->atividade = [];
            }

//           }
        }
    }
}
