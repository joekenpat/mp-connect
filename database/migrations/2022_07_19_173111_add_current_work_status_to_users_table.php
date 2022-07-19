<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentWorkStatusToUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('current_job_status')->nullable()->default(null);
      $table->timestamp('available_for_job_from')->nullable()->default(null);
      $table->timestamp('available_for_fulltime_job_from')->nullable()->default(null);
      $table->string('preferred_job_location_type')->nullable()->default(null);
      $table->integer('preferred_job_hours_per_week')->nullable()->default(null);
      $table->text('preferred_job_countries')->nullable()->default(null);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn([
        'current_job_status',
        'available_for_job_from',
        'available_for_fulltime_job_from',
        'preferred_job_location_type',
        'preferred_job_hours_per_week',
        'preferred_job_countries'
      ]);
    });
  }
}
