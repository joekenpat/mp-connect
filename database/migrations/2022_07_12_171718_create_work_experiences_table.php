<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperiencesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('work_experiences', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->references('id')->on('users');
      $table->string('job_title');
      $table->string('employer_name');
      $table->string('industry');
      $table->integer('start_month');
      $table->integer('start_year');
      $table->integer('end_month')->nullable()->default(null);
      $table->integer('end_year')->nullable()->default(null);
      $table->boolean('is_current_role');
      $table->text('hands_on_technology')->nullable();
      $table->text('description');
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
    Schema::dropIfExists('work_experiences');
  }
}
