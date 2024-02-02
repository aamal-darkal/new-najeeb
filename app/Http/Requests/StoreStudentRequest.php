<?php

namespace App\Http\Requests;

use App\Http\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator ;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'mobile' => ['required', 'unique:App\Models\User,mobile', 'digits:10'],
            'password' => ['required', 'string', 'min:6'],

            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'father_name' => ['required', 'string', 'max:50'] ,
            
            'parent_phone' => ['nullable', 'digits:10'],
            'governorate' => ['required', 'in:دمشق,ريف دمشق,حلب,حمص,اللاذقية,حماه,طرطوس,الرقة,ديرالزور,السويداء,الحسكة,درعا,إدلب,القنيطرة'], 
        ];
        
    }
    protected function failedValidation(Validator $validator)
    {
        $data = $validator->errors();
        throw new HttpResponseException(            
            ResponseHelper::error($data, "Error in validation" , 422));
    }
}
