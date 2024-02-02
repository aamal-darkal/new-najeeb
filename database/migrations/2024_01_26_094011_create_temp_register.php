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
        Schema::create('temp_registers', function (Blueprint $table) {
            $table->id();
            $table->char('mobile', 10)->index();
            $table->string('password');

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('father_name', 50);
            $table->char('parent_phone', 10)->nullable();
            $table->enum('governorate', ['دمشق', 'ريف دمشق', 'حلب', 'حمص', 'اللاذقية', 'حماه', 'طرطوس', 'الرقة', 'ديرالزور', 'السويداء', 'الحسكة', 'درعا', 'إدلب', 'القنيطرة']);

            $table->char('otp', 6)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_registers');
    }
};
