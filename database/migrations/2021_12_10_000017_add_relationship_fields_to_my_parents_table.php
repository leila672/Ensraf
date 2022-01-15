<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMyParentsTable extends Migration
{
    public function up()
    {
        Schema::table('my_parents', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5522063')->references('id')->on('users');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id', 'school_fk_5073629')->references('id')->on('schools');
        });
    }
}
