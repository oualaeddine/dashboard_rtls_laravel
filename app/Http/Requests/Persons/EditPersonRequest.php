<?php

namespace App\Http\Requests\Persons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPersonRequest extends FormRequest
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
            "firstname' => 'required",
            'lastname' => 'required',
            'uid_bracelet' => [
                'required',
                Rule::unique('persons', 'uid_bracelet')->ignore($this->id)
            ],
        ];
    }
}
