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
        Schema::table('care_homes', function (Blueprint $table) {
            if (!Schema::hasColumn('care_homes', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('care_homes', function (Blueprint $table) {
            if (Schema::hasColumn('care_homes', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
