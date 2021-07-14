<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_id',50)->unique();
            $table->double('amount',20,3);
            $table->enum('reason',['withdraw','deposit','add advertise']);
            $table->enum('method',['vf-cash','paypal'])->nullable();
            $table->bigInteger('user_id',false,true);
            $table->boolean('seen')->default(false);
            $table->tinyInteger('request_status')->default(0)->comment('0: no action,1:approved,2:canceled');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
