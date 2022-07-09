<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRefrenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_refrence', function (Blueprint $table) {
            $table->string('name_of_client', 60);
            $table->integer('user_id')->index('user_id');
            $table->string('industry', 60);
            $table->string('description');
            $table->string('functional_skills', 225)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_refrence');
    }
}
