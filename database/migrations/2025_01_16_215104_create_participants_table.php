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
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('names')->index();
            $table->string('last_name')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->foreignId('ubigeo_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('status')->nullable();
            $table->string('educational_institution_type')->nullable();
            $table->boolean('policy')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
