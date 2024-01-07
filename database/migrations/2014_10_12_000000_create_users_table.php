<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            // $table->timestamps();
            $table->id();
            $table->string('name', 50);
            $table->string('last_name', 100);
            $table->string('gender', 1);
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 20);
            $table->string('residential_address');
            $table->string('pesel', 11)->unique();
            $table->date('admission_date')->default(now());
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('role_id')->default(3); // Foreign key column
            $table->timestamp('updated_at')->nullable(); //
            $table->timestamp('created_at')->nullable(); //
            $table->foreign('role_id')
                ->references('role_id')
                ->on('roles');
            $table->string('image')->nullable();//->default('img/user/default/default.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
