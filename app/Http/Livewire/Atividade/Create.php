<?php

namespace App\Http\Livewire\Atividade;


use App\Http\Livewire\Componente\CheckHour;
use App\Http\Service\AgendaService;
use App\Models\Agenda;
use App\Models\Atividade;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\SemanaPeriodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
{
    public $atividade = [];
    public $i = 0;
    public $isSaved = false;
    public $custonOpen = false;
    public $msg;
    public $arrDias = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'];
    public $dias;

    protected $rules = [];

    protected $listeners = ['addCheck' => 'setValues'];

    public function render()
    {
        return view('adm.atividade.create');
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
                'hor_inicio' => ['required', 'string', 'max:255'],
                'hor_fim' => ['required', 'string', 'max:255'],
            ])->validate();

            for ($dia = 0 ; $dia < 7; $dia++ )
            {
                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['num_dia'] = $dia;
                $arrDia['hor_inicio'] = $this->dias['hor_inicio'];
                $arrDia['hor_fim'] = $this->dias['hor_fim'];
                $arrDia['flg_situacao'] = Constant::FLG_ATIVO;
                SemanaPeriodo::create($arrDia);
            }
            return true;
        }
        elseif (isset($this->dias['uteis']))
        {
            Validator::make($this->dias, [
                'hor_inicio' => ['required', 'string', 'max:255'],
                'hor_fim' => ['required', 'string', 'max:255'],
            ])->validate();
            for ($dia = 1 ; $dia < 6; $dia++ )
            {
                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['num_dia'] = $dia;
                $arrDia['hor_inicio'] = $this->dias['hor_inicio'];
                $arrDia['hor_fim'] = $this->dias['hor_fim'];
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
                    'hor_inicio_p' => 'required',
                    'hor_fim_p' => 'required',
                ])->validate();

                $arrDia = [];
                $arrDia['atividade_id'] = $id;
                $arrDia['num_dia'] = Constant::DIAS[key($dia)];
                $arrDia['hor_inicio'] = $dia['hor_inicio_p'];
                $arrDia['hor_fim'] = $dia['hor_fim_p'];
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

}
