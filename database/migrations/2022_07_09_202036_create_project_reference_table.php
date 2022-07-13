<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectReferenceTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('project_references', function (Blueprint $table) {
      $table->id('id');
      $table->foreignId('user_id')->references('id')->on('users');
      $table->string('name_of_client')->nullable()->default(null);
      $table->string('industry')->nullable()->default(null);
      $table->string('document_file')->nullable()->default(null);
      $table->text('description')->nullable()->default(null);
      $table->text('functional_skills')->nullable()->default(null);
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
    Schema::dropIfExists('project_refrences');
  }
}
