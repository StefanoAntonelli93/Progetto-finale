<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRestaurantRequest extends FormRequest
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
            'restaurant_name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('restaurants')->ignore($this->restaurant)],
            'description' => 'nullable|string|max:2000',
            'img' => 'nullable|image|max:4096', // massimo 4MB per l'immagine
            'phone_number' => ['required', 'regex:/^[\+0-9\s\-]+$/', 'min:6', 'max:15', Rule::unique('restaurants')->ignore($this->restaurant)],
            'address' => 'required|string|max:150',
            'p_iva' => ['required', 'digits:11', Rule::unique('restaurants')->ignore($this->restaurant)],
            'categories' => 'nullable|exists:categories,id'
        ];
    }
}
