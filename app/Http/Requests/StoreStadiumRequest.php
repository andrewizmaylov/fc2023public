<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStadiumRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
	        'id' => 'nullable|string|max:36',
	        'name' => 'required|max:100',
	        'slug' => 'nullable',
	        'description' => 'nullable',
	        'details' => 'nullable',
	        'published_at' => 'nullable',
	        'banner' => 'nullable|string|max:255',
	        'logo' => 'nullable|string|max:255',
        ];
    }
}
