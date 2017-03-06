<?php

namespace API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Request;

class UpdateCustomer extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'email' => [
                'email',
                Rule::unique('customers')->ignore(request()->customer->id),
            ],
            'first_name' => 'string|min:2',
            'last_name' => 'string|min:2',
            'gender' => 'in:male,female',
            'country' => 'string|min:2',
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
