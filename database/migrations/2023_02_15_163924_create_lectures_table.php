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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string('name' ,100);
            $table->string('video_link');
            $table->unsignedTinyInteger('seq');
            $table->boolean('free')->default(false);
            $table->foreignId('chapter_id')->constrained(); 
            $table->unique('chapter_id' , 'seq');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
