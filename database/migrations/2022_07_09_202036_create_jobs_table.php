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
            $table->integer('id', true);
            $table->string('title', 100);
            $table->string('industry', 300);
            $table->string('description', 1500);
            $table->string('company', 100)->nullable();
            $table->string('availability', 20)->nullable();
            $table->string('location', 20)->nullable();
            $table->string('country', 30)->nullable();
            $table->integer('experience');
            $table->integer('industryExperience')->nullable();
            $table->string('functionalAreas', 300)->nullable();
            $table->integer('positionsAvailable')->default(1);
            $table->integer('positionsFilled')->default(0);
            $table->integer('noOfInvitesSent')->default(0);
            $table->integer('noOfApplicants')->default(0);
            $table->boolean('status')->default(true);
            $table->dateTime('jobExpiryDate')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
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
