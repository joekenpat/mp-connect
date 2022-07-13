<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardCertificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('award_certifications', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->references('id')->on('users');
      $table->string('title');
      $table->string('proof_file')->nullable()->default(null);
      $table->text('description')->nullable()->default(null);
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
    Schema::dropIfExists('award_certifications');
  }
}
