<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response(
                json_encode(
                    [
                        'success' => false,
                        'message' => 'Validation errors',
                        'errors' => $validator->errors()
                    ]
                ),
                200,
                ['Content-Type' => 'text/json; charset=UTF-8']
            )

        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'q' => 'required|max:255',
            'ln' => 'required|in:english,russian',
            'geo' => 'required|in:en,ru,ua',
            'host' => 'required|max:255',
            'c' => 'integer|min:1|max:100',
        ];
    }
}
