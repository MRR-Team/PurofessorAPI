<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo'=>'sometimes|required|string|max:255',
            'name'=>'sometimes|unique|required|string|max:255',
            'role'=>'sometimes|string|in:mage,adc,tank,supp,fighter,assasin',
            'attack_damage'=>'sometimes|required|boolean',
            'magic_damage'=>'sometimes|required|boolean',
            'shield'=>'sometimes|required|boolean',
            'heals'=>'sometimes|required|boolean',
            'tanky'=>'sometimes|required|boolean',
            'squishy'=>'sometimes|required|boolean',
            'has_cc'=>'sometimes|required|boolean',
            'dash'=>'sometimes|required|boolean',
            'poke'=>'sometimes|required|boolean',
            'can_one_shot'=>'sometimes|required|boolean',
            'late_game'=>'sometimes|required|boolean',
            'is_good_against_attack_damage'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_magic_damage'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_shield'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_heals'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_tanky'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_squish'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_has_cc'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_dash'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_poke'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_can_one_shot'=>'sometimes|required|int|max:10|min:0',
            'is_good_against_late_game'=>'sometimes|required|int|max:10|min:0',
        ];
    }
}
