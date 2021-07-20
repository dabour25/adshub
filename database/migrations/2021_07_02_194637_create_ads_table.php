<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('slug')->unique();
            $table->double('total_cost',10,3);
            $table->double('spent_cost',10,3)->default(0);
            $table->double('available_cost',10,3);
            $table->bigInteger('views',false,true)->default(0);
            $table->bigInteger('clicks',false,true)->default(0);
            $table->integer('max_time',false,true);
            $table->enum('ad_type',['image','page','video','youtube','post']);
            $table->text('ad_view');
            $table->text('link')->nullable();
            $table->boolean('seen')->default(false);
            $table->boolean('approved')->default(false);

            $table->bigInteger('by_user',false,true);
            $table->timestamps();

            $table->foreign('by_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
