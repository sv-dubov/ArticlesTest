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
        Schema::create('seo_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('seo_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->unique(['seo_id', 'locale']);
            $table->foreign('seo_id')->references('id')->on('seos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_translations');
    }
};
