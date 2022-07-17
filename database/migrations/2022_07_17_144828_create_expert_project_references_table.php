<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertProjectReferencesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expert_project_references', function (Blueprint $table) {
      $table->id();
      $table->foreignId('expert_profile_id')->references('id')->on('expert_profiles');
      $table->foreignId('project_reference_id')->references('id')->on('project_references');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('expert_project_references');
  }
}
