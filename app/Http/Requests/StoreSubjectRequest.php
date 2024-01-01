<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:100',
            'cost' => 'required|integer',
            'color' => 'required',
            'days.*' => 'required',
            'start_times.*' => ['required','regex:/(1[012]|[1-9]):[0-5][0-9][\\s]?(?i)(am|pm)/'],
            'end_times.*' => ['required','regex:/(1[012]|[1-9]):[0-5][0-9][\\s]?(?i)(am|pm)/'],
        ];
    }
}
