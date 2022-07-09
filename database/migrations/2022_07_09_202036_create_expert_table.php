<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('email');
            $table->integer('user_id')->index('user_id');
            $table->string('profile_name')->nullable();
            $table->string('profile_description')->nullable();
            $table->string('industry_experience')->nullable();
            $table->string('functional_skills')->nullable();
            $table->string('client_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('description')->nullable();
            $table->string('functional_skill2')->nullable();
            $table->string('project_document', 500)->nullable();
            $table->string('certifications')->nullable();
            $table->string('description2')->nullable();
            $table->string('proof', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expert');
    }
}
