<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'type' => ['required', Rule::in(['I', 'B'])],
                'address' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'postalCode' => ['required'],
                'active' => ['required'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'type' => ['sometimes', 'required', Rule::in(['I', 'B'])],
                'address' => ['sometimes', 'required'],
                'city' => ['sometimes', 'required'],
                'state' => ['sometimes', 'required'],
                'postalCode' => ['sometimes', 'required'],
                'active' => ['sometimes', 'required'],
            ];
        }

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'post_code' => $this->postalCode
        ]);
    }
}
