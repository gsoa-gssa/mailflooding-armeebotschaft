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
        Schema::table('politicians', function (Blueprint $table) {
            $table->enum('salutation', ['male', 'female', 'neutral'])->after('name')->default('neutral');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('politicians', function (Blueprint $table) {
            $table->dropColumn('salutation');
        });
    }
};
