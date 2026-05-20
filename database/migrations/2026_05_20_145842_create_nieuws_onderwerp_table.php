<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nieuws_onderwerp', function (Blueprint $table) {

            $table->foreignId('nieuws_id')
                ->constrained('nieuws')
                ->cascadeOnDelete();

            $table->foreignId('onderwerp_id')
                ->constrained('onderwerpen')
                ->cascadeOnDelete();

            $table->primary([
                'nieuws_id',
                'onderwerp_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nieuws_onderwerp');
    }
};
