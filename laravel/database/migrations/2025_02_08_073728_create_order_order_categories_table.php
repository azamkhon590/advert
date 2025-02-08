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
        Schema::create('order_order_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\OrderCategory::class);
            $table->foreignIdFor(App\Models\Order::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_order_categories');
    }
};
