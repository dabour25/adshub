<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',false,true);
            $table->string('country',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('address',50)->nullable();
            $table->date('age')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->text('interests')->nullable();
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
        Schema::dropIfExists('user_data');
    }
}
