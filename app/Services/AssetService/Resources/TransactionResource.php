<?php

namespace App\Services\AssetService\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'amount' => $this->amount,
            'status' => $this->status->text(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
