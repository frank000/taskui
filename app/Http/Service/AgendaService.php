<?php

namespace App\Http\Service;

use App\Models\Agenda;
use App\Models\Constant;
use App\Models\MarcacaoAtividade;
use App\Models\SemanaPeriodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use QrCode;
use PDF;


class AgendaService
{
    //@var Agenda
    protected $agendaModel;

    function __construct(Agenda $agenda) {
        $this->agendaModel = $agenda;
    }

    public function getAgendaByIdAtividade($idAtividade)
    {
        $token = TokenService::tokenizer($idAtividade);
        $resultDateHour = [];
        //available dates per activite
        $dates = DB::table('agendas')
            ->select(DB::raw('DATE(dat_marcacao) as agenda_dat'))
            ->where(['atividade_id' => $token->id, 'flg_situacao' => Constant::FLG_ATIVO,
                'flg_aberto' => Constant::FLG_AGENDA_ABERTA])
            ->where('client_id', null)
            ->groupBy('agenda_dat')
            ->get();
        //available times to given DATE
        foreach ($dates as $date) {
            $hours = DB::table('agendas')
                ->select(DB::raw('* ,TIME(dat_marcacao) as agenda_tim'), DB::raw('DATE(dat_marcacao) as agenda_dat'))
                ->havingRaw('atividade_id = ? AND flg_situacao = ? AND flg_aberto = ? AND agenda_dat= ? AND client_id IS NULL',
                    [$token->id, Constant::FLG_ATIVO, Constant::FLG_AGENDA_ABERTA, $date->agenda_dat])
                ->get();

            //assembling array to screen on view
            $finalResult = array_map(function ($item){
                return (array)$item;
            },$hours->toArray());

            $resultDateHour[$date->agenda_dat] =  HelperService::group_by('agenda_tim',$finalResult);
        }
        return $resultDateHour;
    }

    public function gerarAgenda($atividade, $resourceId)
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
                ->where(['atividade_id' =>$atividade->id , 'resource_id'=>$resourceId])
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
                    $this->geraHorariosByDia($dataGera, $numPeriodo, $atividade->id,$resourceId);
                }
                $dataGera = Carbon::create($dataGera)->addDays(1)->toDateTimeString();
            }
        }catch (\Exception $e){
            return "Houve um problema ao gerar a agenda:  " . $e->getMessage();
        }

    }
    protected function geraHorariosByDia($date, $periodo, $idAtividade, $resourceId)
    {
        try{
            $per =  SemanaPeriodo::where('num_dia', Carbon::create($date)->dayOfWeek)
                ->where('atividade_id' , $idAtividade)
                ->where('flg_situacao', Constant::FLG_ATIVO)->get();

            $format = 'Y-m-d H:i:s';
            $dateHorInicioMan = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' . $per[0]['hor_inicio_man']);
            $dateHorFimMan = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' .  $per[0]['hor_fim_man']);
            $dateHorInicioTar = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' . $per[0]['hor_inicio_tar']);
            $dateHorFimTar = \DateTime::createFromFormat($format, explode(" ",$date)[0] . ' ' .  $per[0]['hor_fim_tar']);

            //cria os horários para MANHÃ
            $carbonIni = Carbon::parse($dateHorInicioMan);
            $carbonFim = Carbon::parse($dateHorFimMan);
            $minDia = $carbonIni->diffInMinutes($carbonFim);//quantidade de minutos para o dia MANHA

            $qtdAtendimento =  $minDia / $periodo;

            for ($i = 0 ; $i < $qtdAtendimento; $i++)
            {
                $arrHorarios = [];
                $arrHorarios['atividade_id'] = $idAtividade;
                $arrHorarios['resource_id'] = $resourceId;
                $arrHorarios['dat_marcacao'] = $carbonIni->toDateTimeString();
                $arrHorarios['flg_situacao'] = Constant::FLG_ATIVO;
                $arrHorarios['flg_aberto'] = Constant::FLG_AGENDA_ABERTA;
                $carbonIni->addMinutes($periodo);
                Agenda::create($arrHorarios);
            }
            //cria os horários para TARDE
            $carbonIniTar = Carbon::parse($dateHorInicioTar);
            $carbonFimTar = Carbon::parse($dateHorFimTar);
            $minDiaTar = $carbonIniTar->diffInMinutes($carbonFimTar);//quantidade de minutos para o dia Tarde
            for ($i = 0 ; $i < $qtdAtendimento; $i++)
            {
                $arrHorarios = [];
                $arrHorarios['atividade_id'] = $idAtividade;
                $arrHorarios['resource_id'] = $resourceId;
                $arrHorarios['dat_marcacao'] = $carbonIniTar->toDateTimeString();
                $arrHorarios['flg_situacao'] = Constant::FLG_ATIVO;
                $arrHorarios['flg_aberto'] = Constant::FLG_AGENDA_ABERTA;
                $carbonIniTar->addMinutes($periodo);
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

    public function getQrCode($link)
    {
        return base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($link));
    }

    public function schedule($agenda, $client)
    {

    }


}
