<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemanaPeriodo extends Model
{
    use HasFactory;

    protected $fillable = ['atividade_id','resource_id', 'num_dia', 'hor_inicio_man', 'hor_fim_man', 'hor_inicio_tar', 'hor_fim_tar','flg_situacao'];

    public function atividade()
    {
        return $this->belongsTo(Atividade::class,'atividade_id');
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class,'resource_id');
    }


}
