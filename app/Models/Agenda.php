<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = ['atividade_id','resource_id', 'client_id', 'flg_situacao', 'flg_aberto', 'dat_marcacao', 'color'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

    public function getHorasByDate($date, $atividade)
    {
        return DB::table('agendas')
            ->select(DB::raw('TIME(dat_marcacao) as agenda_tim'))
            ->where(['atividade_id'=>$atividade, 'flg_situacao' => Constant::FLG_ATIVO,
                'flg_aberto' => Constant::FLG_AGENDA_ABERTA])
            ->where('client_id',null)
            ->groupBy('agenda_tim')
            ->get();
    }
}
