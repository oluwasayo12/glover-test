<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MakeRequest extends FormRequest
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
            'customer_id' =>  'integer|'.Rule::requiredIf($this->customer_data_action == 'update' || $this->customer_data_action == 'delete'),
            'customer_data_action' => ['required', Rule::in(['create','update','delete'])],
            'customer_data' => Rule::requiredIf($this->customer_data_action == 'create' || $this->customer_data_action == 'update'),
            'customer_data.firstname' => 'sometimes|required|string',
            'customer_data.lastname' => 'sometimes|required|string',
            'customer_data.email' => 'sometimes|required|string',
        ];
    }
}
