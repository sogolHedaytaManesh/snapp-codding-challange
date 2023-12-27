<?php

namespace App\Services\AssetService\Requests;

use App\Services\AssetService\Helpers\DigitHelper;
use App\Services\AssetService\Rules\ValidateCartFormatNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class AssetTransferRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if (DigitHelper::isDigit($this->sender_cart_number, $this->receiver_cart_number)) {

            $this->merge([
                'sender_cart_number' => DigitHelper::toEnglishDigit(
                    DigitHelper::toArray($this->sender_cart_number),
                    'string'
                ),
                'receiver_cart_number' => DigitHelper::toEnglishDigit(
                    DigitHelper::toArray($this->receiver_cart_number),
                    'string'
                ),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'sender_cart_number' => [
                'bail',
                'required',
                'integer',
                new ValidateCartFormatNumberRule(),
            ],
            'receiver_cart_number' => [
                'bail',
                'required',
                'integer',
                'different:sender_cart_number',
                new ValidateCartFormatNumberRule(),
            ],
            'amount' => [
                'bail',
                'required',
                'integer',
                'min:'.config('asset.transaction_mount.min'),
                'max:'.config('asset.transaction_mount.max'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'sender_cart_number.integer' => 'The :attribute should be 16 digits.',
            'receiver_cart_number.integer' => 'The :attribute should be 16 digits.',
        ];
    }
}
