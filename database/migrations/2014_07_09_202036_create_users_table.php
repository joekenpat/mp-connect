<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id('id');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('first_name')->nullable()->default(null);
      $table->string('last_name')->nullable()->default(null);
      $table->string('profile_image')->nullable()->default(null);
      $table->string('gender')->nullable()->default(null);
      $table->string('nationality')->nullable()->default(null);
      $table->string('current_address')->nullable()->default(null);
      $table->string('mobile_phone')->nullable()->default(null);
      $table->string('fixed_phone')->nullable()->default(null);
      $table->integer('years_of_work_experience')->default(0);
      $table->integer('countries_of_work_experience')->default(0);
      $table->string('name_of_professional')->nullable()->default(null);
      $table->string('utm_medium')->nullable()->default(null);
      $table->text('hands_on_technology')->nullable()->default(null);
      $table->text('topic_of_interests')->nullable()->default(null);
      $table->text('areas_of_contribution')->nullable()->default(null);
      $table->text('languages')->nullable()->default(null);
      $table->text('short_bio')->nullable()->default(null);
      $table->timestamp('date_of_birth')->nullable()->default(null);
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
    Schema::dropIfExists('users');
  }
}
