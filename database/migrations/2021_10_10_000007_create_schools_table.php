<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('area');
            $table->string('sector');
            $table->string('name');
            $table->string('classificaion');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->time('end_time');
            $table->time('start_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
