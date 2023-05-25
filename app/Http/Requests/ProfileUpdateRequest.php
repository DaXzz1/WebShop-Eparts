<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:100', 'min:3'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
            'passwordConfirmation' => ['string', 'min:8', 'same:password', 'nullable'],
            'firstName' => ['string', 'max:100', 'min:3'],
            'lastName' => ['string', 'max:100', 'min:3'],
            'phone' => ['string', 'max:100', 'min:3'],
            'address' => ['string', 'max:100', 'min:3'],
            'country' => ['string', 'max:100', 'min:3'],
            'zipCode' => ['string', 'max:100', 'min:3'],
            'city' => ['string', 'max:100', 'min:3'],
            'avatar' => ['image', 'max:4096', 'nullable'],
        ];
    }
}
