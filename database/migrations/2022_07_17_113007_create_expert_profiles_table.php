<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expert_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->references('id')->on('users');
      $table->string('name')->nullable()->default(null);
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
    Schema::dropIfExists('expert_profiles');
  }
}
