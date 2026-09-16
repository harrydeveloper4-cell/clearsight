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
        if (!Schema::hasTable('resident_documents')) {
            Schema::create('resident_documents', function (Blueprint $table) {
                $table->id();

                $table->foreignId('resident_id')->constrained()->onDelete('cascade');
                $table->string('filename');
                $table->string('filepath');
                $table->string('filetype')->nullable();
                $table->unsignedBigInteger('filesize')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_documents');
    }
};
