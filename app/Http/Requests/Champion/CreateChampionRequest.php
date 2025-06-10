<?php

namespace App\Http\Requests\Champion;

use Illuminate\Foundation\Http\FormRequest;

class CreateChampionRequest extends FormRequest
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
            'photo'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'position'=>'required|in:mid,top,jungle,bot,support',
            'role'=>'required|string|in:mage,adc,tank,supp,fighter,assasin',
            'isAvailable'=>'required|boolean',
            'attack_damage'=>'required|boolean',
            'magic_damage'=>'required|boolean',
            'shield'=>'required|boolean',
            'heals'=>'required|boolean',
            'tanky'=>'required|boolean',
            'squishy'=>'required|boolean',
            'has_cc'=>'required|boolean',
            'dash'=>'required|boolean',
            'poke'=>'required|boolean',
            'can_one_shot'=>'required|boolean',
            'late_game'=>'required|boolean',
            'is_good_against_attack_damage'=>'required|int|max:10|min:0',
            'is_good_against_magic_damage'=>'required|int|max:10|min:0',
            'is_good_against_shield'=>'required|int|max:10|min:0',
            'is_good_against_heals'=>'required|int|max:10|min:0',
            'is_good_against_tanky'=>'required|int|max:10|min:0',
            'is_good_against_squish'=>'required|int|max:10|min:0',
            'is_good_against_has_cc'=>'required|int|max:10|min:0',
            'is_good_against_dash'=>'required|int|max:10|min:0',
            'is_good_against_poke'=>'required|int|max:10|min:0',
            'is_good_against_can_one_shot'=>'required|int|max:10|min:0',
            'is_good_against_late_game'=>'required|int|max:10|min:0',
        ];
    }
}
