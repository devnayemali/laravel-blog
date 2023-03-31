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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('division_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('district_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('thana_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('union_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('photo')->nullable();
            $table->string('gender', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
