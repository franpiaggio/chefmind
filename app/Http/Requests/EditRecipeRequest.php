<?php

namespace App\Http\Requests;

use App\Recipe;
use Illuminate\Foundation\Http\FormRequest;

class EditRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user    = app( 'auth' )->user();
        $recipe = Recipe::findOrFail( $this->id );
        return $recipe->user_id === $user->id;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
