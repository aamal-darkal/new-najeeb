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
            $table->string('first_name' , 50);
            $table->string('last_name' , 50);
            $table->string('father_name' , 50);            
            $table->char('phone',10)->unique();
            $table->char('land_line',10)->nullable();
            $table->char('parent_phone',10)->nullable();
            $table->enum('governorate' ,['دمشق' ,'ريف دمشق' , 'حلب','حمص' ,'اللاذقية' , 'حماه'  ,'طرطوس', 'الرقة' ,'ديرالزور', 'السويداء' , 'الحسكة' , 'درعا' , 'إدلب' , 'القنيطرة'])->default('دمشق'); 
            $table->enum('state',['new','current','rejected','past','banned'])->default('new');
            $table->foreignId('user_id')->nullable()->constrained();            
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
