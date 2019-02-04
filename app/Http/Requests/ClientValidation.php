<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientValidation extends FormRequest
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
            'client_name' => 'required|max:100',
            'client_status' => 'required|max:1',
            'client_email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('clients')->ignore( $this->id,'client_id'),
            ],
        ];
    }
}
