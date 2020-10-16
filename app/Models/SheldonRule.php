<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*Esto modelo se  implemento para validacion de el jugador gana o pierde
atraves de cunsultas a la bd tabla sheldon_rules*/
class SheldonRule extends Model
{
    protected $table = 'sheldon_rules';

    protected $fillable = [
        'option_1',
        'option_2',
    ];
}
