<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Service\AgendaService;
use App\Http\Service\TokenService;
use App\Models\Atividade;
use App\Models\Client;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\SemanaPeriodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class Agenda extends Controller
{
    public function getAgendamento(Request $request, $atividade)
    {

        $arrExplode = explode('_',$atividade);
        $atividade = TokenService::tokenizer($arrExplode[0])->id;
        $resource = TokenService::tokenizer($arrExplode[1])->id;
        $start = $request->get('start');
        $end = $request->get('end');

        if(!empty($start) && !empty($end))
        {
            // possivle troca de logica
           $agendamentos = \App\Models\Agenda::whereBetween('dat_marcacao', [$start, $end])
                                                ->where(['atividade_id' => $atividade,
                                                         'resource_id' => $resource])->get();

           $arrResult = [];
           foreach ($agendamentos as $row)
           {
               $arrResult[] = array(
                   'title' => $this->geraTitle($row),
                   'id' => $row['id'],
                   'className'=> $row['id'],
                   'data-target'=>"#exampleModal",
                   'groupId' => $row['id'],
                   'start' => $row['dat_marcacao'],
                   'backgroundColor' => $this->geraColorBg($row),
                   'textColor' => $this->geraTextColor($row),
                   'display' =>  'block',
                   'color' => 'black',
                   'end' => Carbon::parse($row['dat_marcacao'])->addMinutes(10)->toDateTimeString(),
               );
           }
            return json_encode($arrResult);
        }
        return json_encode(array());
    }

    protected function geraTextColor($row)
    {
        if( $row['flg_aberto'] == Constant::FLG_AGENDA_FECHADA || $row['flg_aberto'] == Constant::FLG_AGENDA_CANCELADA)
            return 'white';

        return 'black';
    }

    protected function geraTitle($row)
    {
        if( $row['flg_aberto'] == Constant::FLG_AGENDA_FECHADA)
            return __('Bloqueado');

        if( $row['flg_aberto'] == Constant::FLG_AGENDA_CANCELADA)
            return __('Cancelada');

        if( !empty($row['client_id']))
            return Client::find($row['client_id'])->str_nome;

        return __('Disponível');
    }

    public function geraColorBg($row)
    {
        if( $row['flg_aberto'] == Constant::FLG_AGENDA_FECHADA)
            return '#0000FF';

       if( $row['flg_aberto'] == Constant::FLG_AGENDA_CANCELADA)
                return '#4F4F4F';

        if( empty($row['client_id']))
            return $row['color'];

    return '#32CD32';
    }
    public function cancel(Request $request, $p)
    {

    }

    public function close(Request $request, $p)
    {

    }

    protected function getParam($key, Request $request)
    {
        if($request->has($key) && !empty($request->get($key)))
        {
            return $request->get($key);
        }
        else
        {
            throw new \Exception("Parâmetro : '" . $key . "' não informada corretamente.");
        }
    }


}
