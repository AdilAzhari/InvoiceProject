<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Nette\Utils\Arrays;

class StoresectionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'required|unique:sections|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'section_name.required' =>'Section name required',
            'section_name.unique'=> 'section name already exist',
        ];
    }
}
