<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->boolean('captcha')->default(false);
            $table->boolean('multiple_choice')->default(false);
            $table->boolean('block_by_ip')->default(false);
            $table->boolean('block_by_cookie')->default(false);
            $table->string('password')->nullable();
            $table->timestamp('expires_on')->nullable();
            $table->unsignedInteger('owner_id')->nullable();
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
        Schema::dropIfExists('polls');
    }
}
