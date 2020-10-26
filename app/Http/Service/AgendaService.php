<?php

namespace App\Http\Service;

use App\Models\Agenda;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\SemanaPeriodo;
use Carbon\Carbon;


class AgendaService
{
    //@var Agenda
    protected $agendaModel;

    function __construct(Agenda $agenda) {
        $this->agendaModel = $agenda;
    }

    public function getAgendaByIdAtividade($idAtividade)
    {
        $result = MarcacaoAtividade::where('atividade_id',$idAtividade)
            ->orderBy('dat_marcacao','desc')
            ->get();
        dd($result);
    }

    public function gerarAgenda($atividade)
    {
        try{
            $numPeriodo = $atividade->temp_periodo;
            $datInicio = $atividade->dat_inicio;
            $datFim = $atividade->dat_fim;
            $qtdDias = Carbon::parse($atividade->dat_inicio)->diffInDays($atividade->dat_fim);
            $dataGera = $atividade->dat_inicio;

            //get resources from given activity
            //to any resource I create the Agenda

            $diasSemana = SemanaPeriodo::where('flg_situacao', Constant::FLG_ATIVO)
                ->where('atividade_id' , $atividade->id)
                ->get();
            $arrDias = [];

            foreach ($diasSemana as $dia)
            {
                array_push($arrDias,$dia->num_dia);
            }
            for ($i = 1; $i <= $qtdDias; $i++)
            {
                if(in_array(Carbon::create($dataGera)->dayOfWeek,$arrDias))
                {
//                    if(Carbon::create($dataGera)->dayOfWeek == 1)
//                        dd($dataGera, Carbon::create($dataGera)->dayOfWeek);
                    //gera  os horários
                    $this->geraHorariosByDia($dataGera, $numPeriodo, $atividade->id);
                }
                $dataGera = Carbon::create($dataGera)->addDays(1)->toDateTimeString();
            }
        }catch (\Exception $e){
            return "Houve um problema ao gerar a agenda:  " . $e->getMessage();
        }

    }
    protected function geraHorariosByDia($date, $periodo, $idAtividade)
    {
        try{
            $per =  SemanaPeriodo::where('num_dia', Carbon::create($date)->dayOfWeek)
                ->where('atividade_id' , $idAtividade)
                ->where('flg_situacao', Constant::FLG_ATIVO)->get();

            $format = 'Y-m-d H:i:s';
            $dateHorInicio = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' . $per[0]['hor_inicio']);
            $dateHorFim = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' .  $per[0]['hor_fim']);

            $carbonIni = Carbon::parse($dateHorInicio);
            $carbonFim = Carbon::parse($dateHorFim);

            $minDia = $carbonIni->diffInMinutes($carbonFim);//quantidade de minutos para o dia
            $qtdAtendimento =  $minDia / $periodo;

            for ($i = 0 ; $i < $qtdAtendimento; $i++)
            {
                $arrHorarios = [];
                $arrHorarios['atividade_id'] = $idAtividade;
                $arrHorarios['dat_marcacao'] = $carbonIni->toDateTimeString();
                $arrHorarios['flg_situacao'] = Constant::FLG_ATIVO;
                $arrHorarios['flg_aberto'] = Constant::FLG_AGENDA_ABERTA;
                $carbonIni->addMinutes($periodo);
                Agenda::create($arrHorarios);
            }
        }catch (\Exception $e){
            return "Houve um problema ao gerar o horário para a agenda:  " . $e->getMessage();
        }

    }

    /**
     * Cancela um agendamento, retornado para o usuário email ou sms informando teve seu agendamento cancelado
     */
    public function cancelAgenda()
    {
        $this->agendaModel->flg_aberto = Constant::FLG_AGENDA_CANCELADA;
        return $this->agendaModel->save();
    }


    /**
     * Fecha um agendamento ainda nao registrado
     * return boolean
     */
    public function closeAgenda()
    {
        $this->agendaModel->flg_aberto = Constant::FLG_AGENDA_FECHADA;
        return $this->agendaModel->save();
    }


}
