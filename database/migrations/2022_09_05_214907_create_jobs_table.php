<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longtext('description');
            $table->string('industry');
            $table->enum('availability', ['full-time', 'part-time', 'contract']);
            $table->string('country');
            // $table->string('pay_rate');
            $table->integer('experience');
            $table->integer('candidates_required');
            // $table->enum('location', ['on-site', 'remote', 'hybrid']);
            $table->longtext('industry_experience'); #multiple
            $table->longtext('functional_skills');
            $table->timestamp('deadline'); #previously known as end_on
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
