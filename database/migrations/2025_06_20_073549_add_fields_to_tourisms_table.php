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
        Schema::table('tourisms', function (Blueprint $table) {
            if (!Schema::hasColumn('tourisms', 'entrance_fee')) {
                $table->integer('entrance_fee')->nullable()->after('image');
            }
            if (!Schema::hasColumn('tourisms', 'opening_hours_start')) {
                $table->time('opening_hours_start')->nullable()->after('entrance_fee');
            }
            if (!Schema::hasColumn('tourisms', 'opening_hours_end')) {
                $table->time('opening_hours_end')->nullable()->after('opening_hours_start');
            }
            if (!Schema::hasColumn('tourisms', 'rating')) {
                $table->float('rating', 2, 1)->nullable()->after('opening_hours_end');
            }
            if (!Schema::hasColumn('tourisms', 'total_reviews')) {
                $table->integer('total_reviews')->nullable()->after('rating');
            }
            if (!Schema::hasColumn('tourisms', 'latitude')) {
                $table->float('latitude', 10, 6)->nullable()->after('facilities');
            }
            if (!Schema::hasColumn('tourisms', 'longitude')) {
                $table->float('longitude', 10, 6)->nullable()->after('latitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourisms', function (Blueprint $table) {
            if (Schema::hasColumn('tourisms', 'entrance_fee')) {
                $table->dropColumn('entrance_fee');
            }
            if (Schema::hasColumn('tourisms', 'opening_hours_start')) {
                $table->dropColumn('opening_hours_start');
            }
            if (Schema::hasColumn('tourisms', 'opening_hours_end')) {
                $table->dropColumn('opening_hours_end');
            }
            if (Schema::hasColumn('tourisms', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('tourisms', 'total_reviews')) {
                $table->dropColumn('total_reviews');
            }
            if (Schema::hasColumn('tourisms', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('tourisms', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }
};
