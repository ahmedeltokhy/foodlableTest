<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->enum('type',[1,2])->default(1);
            $table->integer('value')->default(0);
            $table->string('code')->unique();
            $table->dateTime('expires_at')->nullable();
            $table->integer('max_usage')->nullable();
            $table->integer('max_user_usage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
