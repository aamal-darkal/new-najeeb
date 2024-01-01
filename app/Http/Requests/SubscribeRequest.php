<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
            'package_id' => 'required',
            'name' => 'required',
            'cost' => 'required',
            'day' => 'required',
            'start_time' => 'required|date_format:g:i A',
            'end_time' => 'required|date_format:g:i A|after:start_time',
        ];
    }
}
