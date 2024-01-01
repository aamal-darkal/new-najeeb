<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'father_name' => ['required', 'string', 'max:50'] ,
            'phone' => ['required', Rule::unique('App\Models\Student' , 'phone')->ignore($this->student) , 'digits:10'],
            'land_line' => ['nullable',  'digits_between:7,10'],
            'parent_phone' => ['nullable' , 'digits:10'],
            'governorate' => ['nullable','string'],          
        ];
        
    }
}
