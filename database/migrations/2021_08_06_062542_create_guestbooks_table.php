<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('guestbooks')) {
            Schema::create('guestbooks', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('owner',30)->comment('學生帳號');
                $table->foreign('owner')->references('account')->on('members');
                $table->string('name',10)->comment('學生名稱');
                $table->string('article',255)->comment('文章標題');
                $table->time('last_content_time',0);
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
        Schema::dropIfExists('guestbooks');
    }
}
