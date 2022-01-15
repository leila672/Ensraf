<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id', 'school_fk_5072129')->references('id')->on('schools');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5085800')->references('id')->on('users');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_5547572')->references('id')->on('my_parents');
        });
    }
}
