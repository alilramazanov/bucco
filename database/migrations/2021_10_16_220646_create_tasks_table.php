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
            $table->foreignId('task_status_id')->default(1)->constrained('task_statuses');
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('admin_id')->constrained('admins');

            $table->text('description')->nullable();
            $table->boolean('finished')->default(false);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();

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
