<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'broker_url' => 'required',
            'port' => 'required|numeric',
            'username' => 'required',
            'password' => 'required',
            'chanel_subscribe' => 'required',
            'chanel_publish' => 'required',
            'path' => 'required',
            'baudrate' => 'required|numeric',
        ];
    }
}
