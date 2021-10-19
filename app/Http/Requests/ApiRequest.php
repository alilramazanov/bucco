<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Urameshibr\Requests\FormRequest;

abstract class ApiRequest extends FormRequest
{


    /**
     * Determine if user authorized to make this request
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['data' => ['errors' => $validator->errors()]], 422));
    }

    abstract public function rules();

    /**
     * @return array
     */
    public function validated(): array
    {
        return $this->request->all();
    }



}
