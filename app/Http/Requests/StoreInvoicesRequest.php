<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicesRequest extends FormRequest
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

            'customerId' => ['required', 'exists:customers,id'],
            'title' => ['required'],
            'description' => ['required'],
            'amount' => ['required', 'integer'],
            'status' => ['required', Rule::in(['B', 'P', 'V'])],
            'active' => ['required', Rule::in(['Y', 'N'])],
            'billedDate' => ['required', 'date_format:Y-m-d'],
            'paidDate' => ['date'],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'customer_id' => $this->customerId,
            'billed_date' => $this->billedDate,
            'paid_date' => $this->paidDate
        ]);
    }
}
