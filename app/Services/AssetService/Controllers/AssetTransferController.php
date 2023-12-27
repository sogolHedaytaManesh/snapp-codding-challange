<?php

namespace App\Services\AssetService\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AssetService\DataTransferObjects\AssetTransferDto;
use App\Services\AssetService\Helpers\ResponseHelper;
use App\Services\AssetService\Repository\Base\AssetServiceBaseRepository;
use App\Services\AssetService\Requests\AssetTransferRequest;
use Illuminate\Http\JsonResponse;

class AssetTransferController extends Controller
{
    public function __invoke(
        AssetTransferRequest $request,
        AssetServiceBaseRepository $assetTransferService,
    ): JsonResponse {
        $dto = new AssetTransferDto($request);

        abort_if(
            ! $assetTransferService->CheckCartNumberAvailability($dto->getSenderCartNumber()),
            404,
            'Invalid sender cart number!'
        );

        abort_if(
            ! $assetTransferService->CheckCartNumberAvailability($dto->getReceiverCartNumber()),
            400,
            'Invalid receiver cart number!'
        );

        $transaction = $assetTransferService->moneyTransfer(
            $dto->getAmount(),
            $dto->getSenderCartNumber(),
            $dto->getReceiverCartNumber()
        );

        abort_if(
            $transaction === -1,
            400,
            'Insufficient inventory!'
        );

        abort_if(
            $transaction === 0,
            400,
            'Transaction failed!'
        );

        return ResponseHelper::success();
    }
}
