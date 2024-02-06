<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
		    'email' => 'required',
		    'first_name' => 'required|max:100',
		    'second_name' => 'nullable|max:100',
		    'last_name' => 'required|max:100',
		    'birthday' => 'required|date',
		    'tg' => 'required|max:100|string|starts_with:@|regex:/^@[a-zA-Z0-9_-]+$/',
		    'role' => 'required',
		    'team_id' => 'required',
	    ];
    }
}
