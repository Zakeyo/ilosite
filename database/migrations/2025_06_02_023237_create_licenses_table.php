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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->enum('license_type', ['FISICA', 'DIGITAL']);
            $table->enum('duration', ['3m', '6m', '1y', '2y', '5y']);
            $table->json('categories');
            $table->string('transaction_number')->unique();
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->enum('status', ['inactiva', 'activa', 'vencida'])->default('inactiva');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
