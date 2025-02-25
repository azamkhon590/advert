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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->longText("description")->nullable();
            $table->date("date_start")->nullable();
            $table->date("date_end")->nullable();
            $table->enum("status", ["in_progress", "complate", "fail", "freeze"])->default("in_progress");
            $table->integer("budget")->nullable();
            $table->json("comments")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
