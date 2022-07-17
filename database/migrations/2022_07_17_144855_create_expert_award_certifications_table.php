<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertAwardCertificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expert_award_certifications', function (Blueprint $table) {
      $table->id();
      $table->foreignId('expert_profile_id')->references('id')->on('expert_profiles');
      $table->foreignId('award_certification_id')->references('id')->on('award_certifications');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('expert_award_certifications');
  }
}
