<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            // 'nom', 'prenom', 'code_client','tele'
            'nom' => 'required|String',
            'prenom' => 'required|string',
            'code_client' => 'required|string|unique:clients',
            'tele' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/","unique:clients"],
        ];
    }
}
