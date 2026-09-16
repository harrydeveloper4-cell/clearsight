<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            $table->foreignId('care_home_id')->constrained('care_homes')->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete();
            $table->enum('type', [
                'Eye Test',
                'Replacement Glasses',
                'Ear Wax Removal',
                'Hearing Care'
            ]);
            $table->enum('priority', ['Routine', 'Urgent'])->default('Routine');
            $table->enum('status', ['New', 'In Progress', 'Completed'])->default('New');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
