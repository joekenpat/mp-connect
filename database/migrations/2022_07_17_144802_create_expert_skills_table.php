<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertSkillsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expert_skills', function (Blueprint $table) {
      $table->id();
      $table->foreignId('expert_profile_id')->references('id')->on('expert_profiles');
      $table->string('name');
      $table->string('type');
      $table->timestamps();

      $table->unique(['expert_profile_id', 'name', 'type']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('expert_skills');
  }
}
