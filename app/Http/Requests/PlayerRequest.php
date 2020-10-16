<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*validacion del form request*/
        return [
            'player_name' => 'required|min:5|max:100|unique:players,player_name',
        ];
    }

    public function messages()
    {
        /*personalizacion de los mensajes de validacion del form request*/
        return [
            'player_name.required' => 'El nombre del jugador es requerido',
            'player_name.min'      => 'El nombre del jugador debe tener mas de 5 caracteres',
            'player_name.max'      => 'El nombre del jugador debe tener hasta 100 caracteres',
            'player_name.unique'   => 'El nombre del jugador debe ser unico (ya existe un jugador con este nombre)',
        ];
    }
}
