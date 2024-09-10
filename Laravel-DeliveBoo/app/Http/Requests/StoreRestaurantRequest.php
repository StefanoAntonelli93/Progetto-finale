<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StoreRestaurantRequest extends FormRequest
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
            'restaurant_name' => 'required|string|min:3|max:100|unique:restaurants,restaurant_name,',
            'description' => 'nullable|string|max:2000',
            'img' => 'nullable|image|max:4096',
            'phone_number' => 'nullable|string|min:6|max:15',
            'address' => 'nullable|string|max:150',
            'p_iva' => 'nullable|string|size:11|unique:restaurants,p_iva,'
        ];
    }
}
