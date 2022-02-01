<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('login', 50)->unique();
            $table->string('password');
            $table->string('password_visible');
            $table->integer('serial')->nullable();
            $table->integer('number')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('admin_id')->constrained('admins');
            $table->string('user_notification_id');
            $table->string('onesignal_app')->nullable();
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
        Schema::dropIfExists('members');
    }
}
