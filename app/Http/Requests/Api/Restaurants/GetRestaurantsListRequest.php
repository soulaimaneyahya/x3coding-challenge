<?php

namespace App\Http\Requests\Api\Restaurants;

use Illuminate\Foundation\Http\FormRequest;

class GetRestaurantsListRequest extends FormRequest
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
            'latitude' => [
                'nullable',
                'numeric',
                'min:-100',
                'max:100',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'min:-100',
                'max:100',
            ],
        ];
    }
}
