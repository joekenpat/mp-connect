<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->foreignId('expert_profile_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['job in progress', 'short listed', 'accepted', 'rejected', 'hired'])->default('job in progress');
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
        Schema::dropIfExists('job_applications');
    }
}
