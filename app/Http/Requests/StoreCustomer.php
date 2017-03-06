<?php

namespace API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreCustomer extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:customers,email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:male,female',
            'country' => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email' => 'required|email|unique:customers,email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:male,female',
            'country' => 'required|string',
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
