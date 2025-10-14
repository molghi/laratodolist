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
            // $table->integer('user_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
                // foreignId(...)->constrained() creates a proper foreign key reference to the users table.
                // onDelete('cascade') ensures user-related tasks are removed automatically if a user is deleted.
            $table->string('title');
            $table->longText('description');
            $table->string('status')->default('todo'); // ->default('todo') ensures a default status.
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
        Schema::dropIfExists('tasks');
    }
}
