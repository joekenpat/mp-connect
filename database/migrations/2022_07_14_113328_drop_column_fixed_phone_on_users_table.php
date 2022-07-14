<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnFixedPhoneOnUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn(['fixed_phone', 'countries_of_work_experience']);
    });
    Schema::table('users', function (Blueprint $table) {
      $table->text('countries_of_work_experience')->nullable()->default(null);
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
      $table->dropColumn(['countries_of_work_experience']);
      $table->text('fixed_phone')->nullable()->default(null);
      $table->integer('countries_of_work_experience')->default(0);
    });
    Schema::table('users', function (Blueprint $table) {
      $table->integer('countries_of_work_experience')->default(0);
    });
  }
}
