<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobinterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobinterest', function (Blueprint $table) {
            $table->integer('interestId', true);
            $table->integer('jobId');
            $table->integer('userId')->index('userId');
            $table->dateTime('createdDate')->useCurrent();
            $table->timestamp('modifiedDate')->useCurrentOnUpdate()->useCurrent();

            $table->unique(['jobId', 'userId'], 'jobId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobinterest');
    }
}
