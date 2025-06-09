<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->morphs('attachable'); // Crea attachable_id y attachable_type
            $table->enum('type', [
                'photo',
                'local_license_front',
                'local_license_back',
                'license_front',
                'license_back',
                'extra_1',
                'extra_2',
                'extra_3',
            ]);
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
