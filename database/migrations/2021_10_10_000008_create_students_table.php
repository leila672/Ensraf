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
            $table->integer('number');
            $table->string('academic_level');
            $table->string('class_number')->nullable();
            $table->string('parent_identity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
