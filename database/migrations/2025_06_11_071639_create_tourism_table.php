<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tourism', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('category'); // Wisata Alam, Budaya, Kuliner, dll
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->decimal('entrance_fee', 10, 2)->nullable();
            $table->time('opening_hours_start')->nullable();
            $table->time('opening_hours_end')->nullable();
            $table->json('facilities')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tourism');
    }
};