<?php

namespace App\Http\Livewire\Guest;

use App\Http\Controllers\Api\Agenda;
use App\Http\Service\TokenService;
use App\Models\Client;
use App\Models\Constant;
use App\Models\Resource;
use GuzzleHttp\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Selection extends Component
{
    public $dates;

    public $hours;

    public $dateValue;

    public $hourValue;

    public $activity;

    public $resources = [];

    public $resourceId;

    public $client = [];

    public $arrPeriodos = [];

    public $p;


    public function mount(Request $request)
    {
        try {
            $token = TokenService::tokenizer($request->id);
            $this->p = $request->id;
            $this->activity = \App\Models\Atividade::find($token->id)->toArray();

        }catch (\Exception $e)
        {

        }

    }

    public function render()
    {
        return view('livewire.guest.selection');
    }

    public function updatedDateValue($val)
    {
        $this->hours = [];
        $this->hourValue = '';

        $this->hours = $this->dates[$val];
    }

    public function updatedHourValue($val)
    {
        $this->arrPeriodos = $this->hours[$val];
        $this->resources = [];
        foreach ($this->arrPeriodos as $key => $item)
        {
            $this->resources[] = Resource::find($item['resource_id'])->toArray();
        }
    }

    public function save()
    {
        Validator::make($this->client, [
            'num_telefone' => ['required'],
            'str_email' => ['required'],
        ])->validate();

        $cli = Client::where(['num_telefone'=>$this->client['num_telefone']])->get();
        if(count($cli->toArray()) > 0)
        {
            $clientId = $this->updateClient($cli);
        }
        else
        {
            $clientId = $this->createClient();

        }

        if(!empty($clientId))
        {
            $this->createAgenda($clientId);

            session()->flash('message', 'Agendamento realizado com sucesso!');
            session()->put(array(
                'activity' => $this->activity['str_desc'],
                'resource' => Resource::find($this->resourceId)->toArray()['str_name'],
                'client' => $this->client['str_nome'],
                'hour' => $this->hourValue,
                'date' => $this->dateValue
            ));
        }

        redirect()->to('/guest/result');
    }

    /**
     * @return mixed
     */
    protected function getAgendaId()
    {
        $arr = array_filter($this->arrPeriodos, function ($item) {
            return $item['resource_id'] == $this->resourceId;
        });
        return array_pop($arr)['id'];
    }

    /**
     * @return mixed
     */
    protected function createClient()
    {
        $this->client['flg_situacao'] = Constant::FLG_ATIVO;
        $resultCli = Client::create($this->client);
        return $resultCli->toArray()['id'];
    }

    /**
     * @return mixed
     */
    protected function updateClient($cli)    {
        $cli[0]->str_nome = $this->client['str_nome'];
        $cli[0]->str_email = $this->client['str_email'];
        $cli[0]->save();

        return $cli[0]->id;
    }

    /**
     * @param $clientId
     */
    protected function createAgenda($clientId): void
    {
        $agenda = \App\Models\Agenda::find($this->getAgendaId());

        //verify has client.
        if (!empty($agenda->client_id)) {
            session()->flash('message', 'Horário indisponível para o recurso.
                                                    Escolha outro horário, ou outro recurso.');
            redirect()->to('/guest/list-tasks-id/' . $this->p);

        }
        $agenda->client_id = $clientId;
        $agenda->save();
    }


}
