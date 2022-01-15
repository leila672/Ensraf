<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('relative_relation');
            $table->string('company_name')->nullable();
            $table->string('license_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
