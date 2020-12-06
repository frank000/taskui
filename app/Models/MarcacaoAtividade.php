<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcacaoAtividade extends Model
{
    use HasFactory;
    protected $fillable = ['atividade_id', 'user_id', 'flg_situacao', 'flg_aberto', 'dat_marcacao'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }



}
