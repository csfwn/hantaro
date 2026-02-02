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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('template')->after('store_url')->default('classic'); // classic | linktree | catalog
            $table->json('theme')->after('template')->nullable();               // colors, button styles
            $table->json('links')->after('theme')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['template', 'theme', 'links']);
        });
    }
};
