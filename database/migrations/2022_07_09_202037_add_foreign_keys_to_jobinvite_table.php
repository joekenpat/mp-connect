<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJobinviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobinvite', function (Blueprint $table) {
            $table->foreign(['jobId'], 'fk_job_invite_job')->references(['id'])->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['userId'], 'jobinvite_ibfk_1')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobinvite', function (Blueprint $table) {
            $table->dropForeign('fk_job_invite_job');
            $table->dropForeign('jobinvite_ibfk_1');
        });
    }
}
