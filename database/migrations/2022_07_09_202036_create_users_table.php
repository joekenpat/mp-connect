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
            $table->integer('id', true);
            $table->string('email');
            $table->string('password');
            $table->string('profile_image', 500)->nullable();
            $table->string('first_name', 225)->nullable();
            $table->string('last_name', 225)->nullable();
            $table->string('gender', 225)->nullable();
            $table->string('nationality')->nullable();
            $table->string('current_location', 225)->nullable();
            $table->integer('phone_number')->nullable();
            $table->integer('fixed_line')->nullable();
            $table->integer('years_owe')->nullable();
            $table->string('countries_owe', 30)->nullable();
            $table->string('hands_on_tech', 225)->nullable();
            $table->string('platform_from', 225)->nullable();
            $table->string('name_of_professional', 225)->nullable();
            $table->string('language', 225)->nullable();
            $table->string('fluency_level', 225)->nullable();
            $table->string('bio', 500)->nullable();
            $table->string('name_of_employer', 225)->nullable();
            $table->string('job_title', 225)->nullable();
            $table->string('industry', 225)->nullable();
            $table->string('functional_activities', 225)->nullable();
            $table->string('start_date', 225)->nullable();
            $table->string('start_year', 225)->nullable();
            $table->string('currently_w_role', 225)->nullable();
            $table->string('end_date', 225)->nullable();
            $table->string('end_year', 225)->nullable();
            $table->string('description_1', 225)->nullable();
            $table->string('client_name', 225)->nullable();
            $table->string('industry1', 225)->nullable();
            $table->string('description_2', 225)->nullable();
            $table->string('functional_skills', 225)->nullable();
            $table->string('project_document', 225)->nullable();
            $table->string('industry_experience', 225)->nullable();
            $table->string('functional_skills_2', 225)->nullable();
            $table->string('next_available', 225)->nullable();
            $table->string('work_status', 225)->nullable();
            $table->string('work_type', 225)->nullable();
            $table->string('hours_per_week', 225)->nullable();
            $table->string('ff_time_availability', 225)->nullable();
            $table->string('work_type2', 225)->nullable();
            $table->string('available_time_now', 225)->nullable();
            $table->string('location_to_work_in', 225)->nullable();
            $table->integer('per_diem_rates')->nullable();
            $table->string('certification', 225)->nullable();
            $table->string('description', 225)->nullable();
            $table->string('file_for_proof', 225)->nullable();
            $table->string('topics_of_interest', 225)->nullable();
            $table->string('contribute', 225)->nullable();
            $table->date('created_at');
            $table->timestamp('modified_at')->useCurrentOnUpdate()->useCurrent();
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
