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
        Schema::create('lib_department_roster_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('lib_department_rosters_id');
            $table->integer('lib_employees_id');
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->boolean('off_day')->default(false);
            //$table->integer('serial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_department_roster_employees');
    }
};
