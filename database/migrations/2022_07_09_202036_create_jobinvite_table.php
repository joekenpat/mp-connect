<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobinviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobinvite', function (Blueprint $table) {
            $table->integer('inviteId', true);
            $table->integer('jobId');
            $table->integer('userId')->index('userId');
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('jobinvite');
    }
}
