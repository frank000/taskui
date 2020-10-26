<?php


namespace App\Models;


class Constant
{
    const FLG_ATIVO = 'A';
    const FLG_INATIVO = 'I';

    const FLG_AGENDA_ABERTA = 'A';
    const FLG_AGENDA_FECHADA = 'F';
    const FLG_AGENDA_CANCELADA = 'C';

    const TYPE_OUTRO = 1;
    const TYPE_PESSOA = 2;
    const TYPE_BOX = 3;

    const DIAS = ['dom'=> 0,'seg' => 1 , 'ter' => 2, 'qua' => 3, 'qui' => 4,
                  'sex' => 5, 'sab' => 6];

    const COMPLETE_DAYS = ['dom'=> 'Domingo','seg' => 'Segunda' , 'ter' => 'Terça', 'qua' => 'Quarta', 'qui' => 'Quinta',
                  'sex' => 'Sexta', 'sab' => 'Sábado'];



}
