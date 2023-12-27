<?php

namespace App\Services\AuthenticationService\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendOTPRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mobile' => ['required', 'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
        ];
    }
}
