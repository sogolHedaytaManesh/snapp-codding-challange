<?php

use App\Services\AssetService\Enums\AccountNumberStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts_number', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_active')->default(AccountNumberStatusEnum::ACTIVE->value)
                ->comment(AccountNumberStatusEnum::asJson());
            $table->string('account_number')->unique();
            $table->unsignedBigInteger('balance')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts_number');
    }
};
