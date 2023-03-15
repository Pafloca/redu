<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name',100);
            $table->string('acronym',10);
            $table->bigInteger('user_teacher_id')->unsigned()->default(1);
            $table->foreign('user_teacher_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',100);
            $table->string('description',500);
            $table->bigInteger('user_teacher_id')->unsigned()->default(1);
            $table->foreign('user_teacher_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('group_id')->unsigned()->default(1);
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('tasks_alumn', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',100);
            $table->string('description',500);
            $table->bigInteger('user_alumn_id')->unsigned()->default(1);
            $table->foreign('user_alumn_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('task_id')->unsigned()->default(1);
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('user_group', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('groups_id')->unsigned();
            $table->primary(['user_id', 'groups_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('groups_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
