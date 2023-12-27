<?php

use App\Services\AssetService\Enums\TransactionStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained();
            $table->string('ref_id');
            $table->bigInteger('amount');
            $table->tinyInteger('status')->default(TransactionStatusEnum::SUCCESS->value)
                ->comment(TransactionStatusEnum::asJson());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
