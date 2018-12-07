<?php

namespace App\Http\Requests;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EditRecipeRequest extends FormRequest
{
    /**
     * Verifica que el usuario sea dueño de la receta
     *
     * @return bool
     */
    public function authorize()
    {
        $user   = Auth::user();
        $recipe = Recipe::findOrFail( $this->id );
        return intval($recipe->user_id) === $user->id;
        
    }

    /**
     * Reglas de validación
     * Aunque no las use tienen que ir vacias
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
