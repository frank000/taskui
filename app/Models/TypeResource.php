<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeResource extends Model
{
    use HasFactory;

    protected $fillable = [ 'str_name', 'flg_sit'];
}
