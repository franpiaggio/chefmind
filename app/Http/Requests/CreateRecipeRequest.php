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
            'body' => 'required|min:5',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     *  Mensajes de validación
     * 
     *  @return array
     */
    public function messages(){
        return [
            'title.required' => 'El nombre es obligatorio.',
            'title.min' => 'El título debe tener un mínimo de 3 caracteres',
            'body.required' => 'La receta debe tener una descripción con instrucciones.',
            'featured_image.required' => 'La receta debe tener al menos una imagen destacada.',
            'featured_image.image' => 'El archivo debe ser una imagen.',
            'featured_image.mimes' => 'Los formátos válidos son: jpeg, png, jpg, gif o svg y 2MB como máximo.'
        ];
    }
}
