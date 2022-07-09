<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJobapplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobapplication', function (Blueprint $table) {
            $table->foreign(['jobId'], 'fk_job_application_job')->references(['id'])->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['expertProfileId'], 'jobapplication_ibfk_2')->references(['id'])->on('expert')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['userId'], 'jobapplication_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobapplication', function (Blueprint $table) {
            $table->dropForeign('fk_job_application_job');
            $table->dropForeign('jobapplication_ibfk_2');
            $table->dropForeign('jobapplication_ibfk_1');
        });
    }
}
