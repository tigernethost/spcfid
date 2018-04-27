<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->bigInteger('rfid');
            $table->string('member_id')->nullable();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->integer('department_id');
            $table->boolean('status')->nullable();
            $table->text('image')->nullable();
            $table->text('signature')->nullable();
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
        Schema::drop('members');
    }
}
