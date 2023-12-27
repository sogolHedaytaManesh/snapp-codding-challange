<?php

namespace App\Services\AssetService\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AssetService\Repository\Base\AssetServiceBaseRepository;
use App\Services\AssetService\Resources\AssetTheMostTransactionsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AssetTheMostTransactionsController extends Controller
{
    public function __invoke(AssetServiceBaseRepository $assetTransferService): AnonymousResourceCollection
    {
        $transactions = $assetTransferService->theMostTransactions();

        return AssetTheMostTransactionsResource::collection($transactions);
    }
}
