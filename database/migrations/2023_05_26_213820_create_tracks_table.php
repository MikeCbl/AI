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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('img');
            $table->decimal('price_per_hour', 8, 2);
            $table->text('description');
            $table->boolean('is_available')->default(true); // 30.05 nowa kolumna czy dostepna
            $table->timestamp('created_at')->default(now()); // Add nullable timestamp column
            $table->timestamp('updated_at')->nullable(); // Add nullable timestamp column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
