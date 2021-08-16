<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class WidgetRequest extends FormRequest
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
            'id' => 'nullable|int',
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:100',

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge($this->json()->all());
        //$this->request = $this->request->json();
    }

}
