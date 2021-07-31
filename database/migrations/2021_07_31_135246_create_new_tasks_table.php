<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description');

            $table->enum('priority', ['high', 'mid', 'low']);
            $table->enum('status', ['completed', 'pending']);

            $table->dateTime('due_time');

            $table->unsignedBigInteger('board_id');
                        
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
        Schema::dropIfExists('new_tasks');
    }
}
