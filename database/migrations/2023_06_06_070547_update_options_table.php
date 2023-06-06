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
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('options', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('image')->nullable();
            $table->dropColumn('name');
        });
    }
};
