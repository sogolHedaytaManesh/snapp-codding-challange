<?php

use App\Services\AssetService\Enums\CartStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('account_number_id')->constrained('accounts_number');
            $table->tinyInteger('status')->default(CartStatusEnum::ACTIVE->value)
                ->comment(CartStatusEnum::asJson());
            $table->string('cart_number')->unique()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
