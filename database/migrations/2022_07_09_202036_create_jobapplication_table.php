<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobapplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobapplication', function (Blueprint $table) {
            $table->integer('appId', true);
            $table->integer('jobId');
            $table->integer('userId')->index('userId');
            $table->integer('expertProfileId')->nullable()->index('expertProfileId');
            $table->string('appDescription', 450)->nullable();
            $table->string('status', 20)->default('pending');
            $table->dateTime('createdDate')->useCurrent();
            $table->timestamp('modifiedDate')->useCurrentOnUpdate()->useCurrent();

            $table->unique(['jobId', 'userId'], 'job_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobapplication');
    }
}
