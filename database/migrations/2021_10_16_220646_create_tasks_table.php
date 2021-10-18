<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_template_id')->constrained('task_templates');
            $table->foreignId('task_status_id')->constrained('task_statuses');
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('member_id')->constrained('members');

            $table->text('description')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_time')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
