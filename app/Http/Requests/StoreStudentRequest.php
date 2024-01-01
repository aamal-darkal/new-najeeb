<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'father_name' => ['required', 'string', 'max:50'] ,
            'phone' => ['required','unique:App\Models\Student,phone' , 'digits:10'],
            'land_line' => ['nullable',  'digits_between:7,10'],
            'parent_phone' => ['nullable' , 'digits:10'],
            'governorate' => ['nullable','string'],
            'subjects_ids' => ['required', 'array'],
            'subjects_ids.*' => ['required', 'exists:subjects,id'],
            'amount' => ['required' ,'integer'],
            'bill_number' => ['nullable' , 'digits_between:1,20'],
            'payment_method_id' =>['nullable','exists:App\Models\PaymentMethod,id']
        ];
        
    }
}
