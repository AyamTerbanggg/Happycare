<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tourism', function (Blueprint $table) {
            $table->dropColumn('gallery');
        });
    }

    public function down()
    {
        Schema::table('tourism', function (Blueprint $table) {
            $table->json('gallery')->nullable();
        });
    }
};
