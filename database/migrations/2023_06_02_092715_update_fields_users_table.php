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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('description');
            $table->string('phone_num');
            $table->enum('type', ['admin', 'gym']);
            $table->string('logo')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function($table) {
            $table->dropColumn('image');
            $table->dropColumn('status');
            $table->dropColumn('description');
            $table->dropColumn('phone_num');
            $table->dropColumn('type');
            $table->dropColumn('logo');
        });
    }
};
