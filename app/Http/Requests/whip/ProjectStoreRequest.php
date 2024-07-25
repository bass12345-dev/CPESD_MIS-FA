<?php

namespace App\Http\Requests\whip;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
        $default_connection = config('app._database.lls_whip');
        return [
                'contractor_id'         => 'nullable',
                'project_title'         => 'required|string|min:3',
                'project_cost'          => ['required','numeric', 'min:1','max:1000000000000.99', 'regex:/^\d+(\.\d{1,2})?$/'],
                'street'                => 'required|string|min:3',
                'barangay'              => 'required|string|min:3',
                'city'                  => 'required|string|min:3',
                'province'              => 'required|string|min:3',
        ];
    }
}
