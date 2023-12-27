<?php

namespace App\Services\AssetService\DataTransferObjects;

use App\Services\AssetService\Requests\AssetTransferRequest;

class AssetTransferDto
{
    private readonly string $senderCartNumber;

    private readonly string $receiverCartNumber;

    private readonly int $amount;

    public function __construct(AssetTransferRequest $request)
    {
        $this->senderCartNumber = $request->validated('sender_cart_number');
        $this->receiverCartNumber = $request->validated('receiver_cart_number');
        $this->amount = $request->validated('amount');
    }

    public function getSenderCartNumber(): string
    {
        return $this->senderCartNumber;
    }

    public function getReceiverCartNumber(): string
    {
        return $this->receiverCartNumber;
    }

    public function getAmount(): int
    {
        return $this->amount * 10;
    }

    public static function fromApiRequest(AssetTransferRequest $request): self
    {
        return new self($request);
    }
}
