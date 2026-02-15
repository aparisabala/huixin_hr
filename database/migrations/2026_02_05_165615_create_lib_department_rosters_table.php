<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lib_department_rosters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lib_department_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('lib_department_roster_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('lib_department_rosters_id');
            $table->integer('lib_employees_id');
            $table->integer('lib_company_shifts_id')->nullable();
            $table->date('date')->nullable();
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->tinyInteger('off_day')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_department_roster_employees');
        Schema::dropIfExists('lib_department_rosters');
    }
};
