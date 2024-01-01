<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class StoreLectureRequest extends FormRequest
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
            'week_program_id' => 'required',
            'subject_id' => 'required',
            'name' => 'required',
            'date' => 'required|date',
            'video_link' => 'required',
            'duration' => 'sometimes',
            'pdf_files.*' => 'sometimes|mimes:pdf',
            // 'pdf_file_name' => 'required_if:pdf_file,!=,null'
        ];
    }


}
