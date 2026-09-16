<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('care_home_id')->constrained('care_homes')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('funding_status')->nullable();
            $table->date('last_eye_test')->nullable();
            $table->date('next_recall_date')->nullable();
            $table->enum('status', ['ok', 'due', 'overdue'])->default('ok');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
