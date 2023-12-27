<?php

namespace App\Services\AssetService\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetTheMostTransactionsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'total_transactions' => $this->total_transactions,
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
        ];
    }
}
