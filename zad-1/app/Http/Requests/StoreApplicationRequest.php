<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|regex:/^\d{3}-\d{3}-\d{3}$/',
            'email' => 'required|email:dns|max:100',
            'receipt_number' => 'required|string|max:50',
            'purchase_date' => 'required|date_format:d-m-Y|before_or_equal:today|after_or_equal:15-06-2024',
            'receipt_image' => 'required|file|image|max:5120',
            'terms_accepted' => 'required|boolean|accepted',
            'marketing_consent' => 'nullable|boolean',
        ];
    }
}
