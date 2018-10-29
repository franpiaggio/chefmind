<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRecipeRequest extends FormRequest
{
    /**
     * Verifica que el usuario esté autorizado
     *
     * @return bool
     */
    public function authorize()
    {
        if( Auth::check() ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Validaciones para la request
     *
     * @return array
     */
    public function rules(){
        return [
            'title' => 'required|min:3',
            'body' => 'required'
        ];
    }
}
