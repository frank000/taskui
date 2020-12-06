<?php

namespace App\Http\Livewire\Atividade;

use App\Events\SendNotification;
use App\Http\Controllers\Api\Agenda;
use App\Http\Service\AgendaService;
use App\Http\Service\TokenService;
use App\Models\Atividade;
use App\Models\Client;
use App\Models\Constant;
use App\Models\Resource;
use App\Models\SemanaPeriodo;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use PDF;

use Livewire\Component;


class Show extends Component
{
    public $atividade;

    /**
     * variable para selectio on the screen
     * @var string
     */
    public $activity;

    public $atividades;

    /**
     * @var Atividade
     */
    public $atividadeObj;

    public $isShowed = false;

    public  $lista;

    /**
     * @var \App\Models\Agenda
     */
    public $agenda;

    public $msg;

    public $isSaved;

    /**
     * id em formato de base 64 para consumo da API, usado na tela
     * @var string base64
     */
    public $p;

    public $isMarked = false;

    public $isClosed = 0;

    public $isCanceled = false;

    public $agendaObject ;
    /**
     * @var Client
     */
    public $client;

    public $resources;

    public $idAgenda;

    public $resource;

    protected $listeners = ['modalAgendaEvent' => 'showModal',
                            'cancelAgendaEvent' => 'cancelAgenda',
                            'closeAgendaEvent' => 'closeAgenda',
                            'openAgendaEvent' => 'openAgenda',
                            'loadResourceEvent' => 'loadResource',
                            'linkAgendaEvent' => 'linkAgenda'];

    public function mount(Request $request)
    {





    }

    public function render()
    {
        //$this->lista = Json::encode('[{title: "All Day Event", start: "2020-09-01"}]');
      //  dd(Json::encode('{title: "All Day Event", start: "2020-09-01"}'));
        $this->atividades = Atividade::getAllActive();
        return view('livewire.atividade.show');
    }

    public function showModal($idAgenda)
    {
        //zera para segunda rebder
        $this->isCanceled = false;

        $this->idAgenda = $idAgenda;


        $this->isMarked = false;
        $this->client = [];

//        $this->p = TokenService::getToken(array('type' => 'agenda',
//                                                'id' => $idAgenda,
//                                                'created' => date('m/d/Y h:i:s a', time())));

        $result = \App\Models\Agenda::where('id',$idAgenda)->get()[0];
        $this->agenda = $result->toArray();
        $this->agendaObject = $result;
        $this->atividadeObj = $result->atividade()->get()->toArray()[0];


        $this->matchCorrectActionButtonFAB( $this->agenda );

        if(count($result->client()->get()->toArray()) > 0){
            $this->client = $result->client()->get()->toArray()[0];
            $this->isMarked = true;


        }
        $this->emit('showEvent',$idAgenda);
    }

    /**
     *  Match correct screen of action button on Modal on Show
     */
    protected function matchCorrectActionButtonFAB($agenda)
    {
        if($agenda['client_id']  && $agenda['flg_aberto'] == Constant::FLG_AGENDA_ABERTA){
            $this->isClosed = 1; //cancel
        }
        elseif ( is_null( $agenda['client_id'] )  && $agenda['flg_aberto'] == Constant::FLG_AGENDA_FECHADA){
            $this->isClosed = 2; //open
        }
        elseif (is_null( $agenda['client_id'] )  && $agenda['flg_aberto'] == Constant::FLG_AGENDA_ABERTA){
            $this->isClosed = 3; //close
        }
        elseif ($agenda['client_id']  && $agenda['flg_aberto'] == Constant::FLG_AGENDA_CANCELADA){
            $this->isClosed = 4; //close
        }

    }

    /**
     * Registry a client to a Schedule
     * @param $array
     * @return string
     */
    public function linkAgenda($array)
    {
        $tokService = new TokenService();


        $array['token'] = $tokService->getToken(array(
            'type' => 'agenda',
            'id' => $this->agenda['id'],
            'created' => new \DateTime(),
        ));
        try{
            $var = Client::where('str_nome',$array['str_nome'])->get();
            if(count($var) == 0)
            {
                $result = Client::create($array);
            }
            else
            {
                $result =  $var[0];
            }

            $ret = \App\Models\Agenda::where('id', $this->agenda['id'])
                ->update(['client_id'=>$result->id, 'flg_aberto' =>Constant::FLG_AGENDA_ABERTA]);
            if($ret > 0)
            {
                $details = [
                    'to' => $result['str_email'],
                    'title' => 'Notificação de Agendamento - Agendrix | taskUI',
                    'body' => 'This is for testing email using smtp'
                ];
//                event(new SendNotification($details));

                \Illuminate\Support\Facades\Notification::route('mail', $details['to'])
                    ->notify(new UserNotification($details));

                $this->isSaved = true;
                $this->msg = "Registro salvo com sucesso.";
                $this->emit('linkAgendaEndEvent');
            }

        }catch (\Exception $exception){
            return "Erro : " . $exception->getMessage();
        }
    }

    public function getClosedProperty()
    {
        if(!is_null($this->agendaObject))
        {
            if(count($this->agendaObject->client()->get()->toArray()) > 0){
                return true;
            }
        }
        return false;
    }
    public function cancelAgenda($p)
    {
        $ageService = new AgendaService(\App\Models\Agenda::where('id',$this->idAgenda)->get()[0]);
        $ageService->cancelAgenda();
        if($ageService->cancelAgenda()){

            $this->emit('cancelAgendaEndEvent');
        }

    }

    public function closeAgenda($p)
    {
        $ageService = new AgendaService(\App\Models\Agenda::where('id',$this->idAgenda)->get()[0]);
        if($ageService->closeAgenda()){

            $this->emit('closeAgendaEndEvent');
        }
    }

    public function openAgenda($p)
    {
        $ageService = new AgendaService(\App\Models\Agenda::where('id',$this->idAgenda)->get()[0]);
        if($ageService->openAgenda()){
           // session()->flash('message', __('Atividade desbloqueada com sucesso!'));
            $this->emit('returnEndEvent',['title'=> __('Aviso!'),
                                                'msg'=>__('Agendamento desbloqueado com sucesso!')]);
        }
    }

    public function updatedResource($val)
    {
        if(!empty($val))
            $this->emit('renderCalendarEvent',$val);
    }

    public function updatedActivity($val)
    {
        $this->resource = '';
        $this->p = TokenService::getToken(array('type' => 'agenda',
                                        'id' => $val,
                                        'created' => date('m/d/Y h:i:s a', time())));
//        if(!empty($val)) {
//                    $result = SemanaPeriodo::where(['atividade_id'=>TokenService::tokenizer($val)->id])->groupBy('resource_id')->get('resource_id');
//        $this->resources = $result->map(function ($item){
//                            return $item->resource->toArray();
//                        });
//        }
    }

    public function loadResource($val)
    {
            $result = SemanaPeriodo::where(['atividade_id'=>$val])
                                        ->groupBy('resource_id')->get('resource_id');
            $this->resources = $result->map(function ($item) {
                            return $item->resource->toArray();
                        });
    }

    public $pdf1;

    public function printQrCode()
    {
        $this->pdf1 = PDF::loadView('adm.pdf.qrcode');
        $this->pdf1->stream();

    }
}
