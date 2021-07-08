<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id',60)->unique();
            $table->double('amount',8,3);
            $table->integer('watch_time',false,true);
            $table->boolean('click')->default(false);

            $table->bigInteger('by_user',false,true);
            $table->bigInteger('from_user',false,true);
            $table->bigInteger('ad_id',false,true);
            $table->bigInteger('trans_id',false,true);
            $table->timestamps();

            $table->foreign('by_user')->references('id')->on('users');
            $table->foreign('from_user')->references('id')->on('users');
            $table->foreign('ad_id')->references('id')->on('ads');
            $table->foreign('trans_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_transactions');
    }
}
