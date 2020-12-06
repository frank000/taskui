<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['str_nome', 'user_id', 'str_email', 'num_telefone', 'token', 'flg_situacao'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
