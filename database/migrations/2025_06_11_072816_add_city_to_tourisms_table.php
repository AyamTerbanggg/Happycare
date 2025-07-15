<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityToTourismsTable extends Migration
{
    public function up(): void
    {
        Schema::table('tourisms', function (Blueprint $table) {
            $table->string('city')->after('location')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tourisms', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
}
