<?php

namespace App\Models;

use App\Http\Service\TokenService;
use App\Models\Traits\CryptId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;
    use CryptId;

    protected $fillable = ['str_atividade','str_desc', 'temp_periodo', 'str_img',
        'dat_inicio', 'dat_fim', 'flg_situacao',  'user_id'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semanaPeriodos()
    {
        return $this->hasMany(SemanaPeriodo::class);
    }


    public static function getAllActive()
    {
        $result = Atividade::orderBy('id', 'DESC')
            ->where('flg_situacao',Constant::FLG_ATIVO)
            ->get()
            ->map(function ($item, $key){
            $arr = $item->toArray();
            $arr['id'] = TokenService::getToken(array('type' => 'atividade',
                'id' => $item->toArray()['id'],
                'created' => date('m/d/Y h:i:s a', time())));
            return (object)$arr;
        });

        return $result;
    }

}
