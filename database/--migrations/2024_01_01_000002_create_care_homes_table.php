<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('care_homes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('manager_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('care_homes');
    }
};
