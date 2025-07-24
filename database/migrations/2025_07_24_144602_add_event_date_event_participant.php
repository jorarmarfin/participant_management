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
        Schema::table('event_participant', function (Blueprint $table) {
            $table->dateTime('event_date')->nullable()->useCurrent()->after('event_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_participant', function (Blueprint $table) {
            $table->dropColumn('event_date');
        });
    }
};
