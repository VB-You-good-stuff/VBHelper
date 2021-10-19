<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('contents')) {
            Schema::create('contents', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('guest_id');
                $table->foreign('guest_id')->references('id')->on('guestbooks');
                $table->string('detail_account',30)->comment('學生帳號');
                $table->foreign('detail_account')->references('account')->on('members');
                $table->string('name',10)->comment('學生名稱');
                $table->string('detail',255);
                $table->smallInteger('floor')->comnet('文章樓層');
                $table->softDeletes();
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
        Schema::dropIfExists('contents');
    }
}
