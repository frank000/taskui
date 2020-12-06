<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'flg_sit', 'str_name', 'type_resource_id'];

    public function typeResource()
    {
        return $this->hasOne(TypeResource::class,'id','type_resource_id');
    }

    public function semanaPeriodos()
    {
        return $this->hasMany(SemanaPeriodo::class,'resource_id');
    }

}
