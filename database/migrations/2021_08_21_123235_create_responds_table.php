<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('responds')) {
            Schema::create('responds', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('content_id');
                $table->foreign('content_id')->references('id')->on('contents');
                $table->string('reply_account',30)->comment('學生帳號');
                $table->foreign('reply_account')->references('account')->on('members');
                $table->string('name',10)->comment('學生名稱');
                $table->string('reply',255);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responds');
    }
}
