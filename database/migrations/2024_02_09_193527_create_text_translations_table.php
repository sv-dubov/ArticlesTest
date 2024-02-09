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
        Schema::create('text_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('text_id');
            $table->string('locale')->index();
            $table->text('content')->nullable();
            $table->unique(['text_id', 'locale']);
            $table->foreign('text_id')->references('id')->on('texts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_translations');
    }
};
