<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->integer('number');
            $table->string('academic_level');
            $table->string('relative_relation');
            $table->string('company_name')->nullable();
            $table->integer('license_number')->nullable();
            $table->string('identity_num');
            $table->string('class_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
