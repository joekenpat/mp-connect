<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJobinterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobinterest', function (Blueprint $table) {
            $table->foreign(['jobId'], 'fk_job_interest_job')->references(['id'])->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['userId'], 'jobinterest_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobinterest', function (Blueprint $table) {
            $table->dropForeign('fk_job_interest_job');
            $table->dropForeign('jobinterest_ibfk_1');
        });
    }
}
