<?php

namespace App\Http\Requests\Persons;

use App\Enums\PersonTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddPersonRequest extends FormRequest
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
        return [
            'firstname' => 'required',
            'lastname' => 'required',
//            'type' => [
//                'required',
//                Rule::in(PersonTypes::toArray()),
//            ],
            'uid_bracelet' => 'required|unique:persons',
        ];
    }
}
