<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // nullable so existing appointments don't break
            $table->foreignId('patient_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('patients')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Patient::class);
            $table->dropColumn('patient_id');
        });
    }
};