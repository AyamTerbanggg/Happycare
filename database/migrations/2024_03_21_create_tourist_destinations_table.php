<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tourist_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // nature, cultural, historical, etc.
            $table->string('address');
            $table->string('city');
            $table->text('description');
            $table->json('facilities');
            $table->string('opening_hours');
            $table->decimal('entrance_fee', 10, 2);
            $table->string('image_url')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tourist_destinations');
    }
}; 