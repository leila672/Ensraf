<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSchoolsTable extends Migration
{
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5122145')->references('id')->on('users');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_5547563')->references('id')->on('cities');
        });
    }
}
