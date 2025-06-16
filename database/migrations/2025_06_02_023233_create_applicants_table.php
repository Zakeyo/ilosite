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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->date('birth_date');
            $table->string('email')->nullable();
            $table->string('country_of_origin');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('passport_number')->nullable();
            $table->unsignedSmallInteger('height_cm');
            $table->string('eye_color');
            $table->enum('gender', ['M', 'F']);
            $table->string('blood_type');
            $table->boolean('has_local_license');
            $table->foreignId('referred_id')->nullable()->constrained('referreds')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
