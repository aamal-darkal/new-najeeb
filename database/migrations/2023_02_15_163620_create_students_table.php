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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name' , 50)->index();
            $table->string('last_name' , 50)->index();
            $table->string('father_name' , 50)->index();            
            $table->char('parent_phone',10)->nullable();
            $table->enum('governorate' ,['دمشق' ,'ريف دمشق' , 'حلب','حمص' ,'اللاذقية' , 'حماه'  ,'طرطوس', 'الرقة' ,'ديرالزور', 'السويداء' , 'الحسكة' , 'درعا' , 'إدلب' , 'القنيطرة'])->index();
            $table->enum('state',['new','current','past','banned'])->default('new')->index();
            $table->foreignId('user_id')->constrained();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
