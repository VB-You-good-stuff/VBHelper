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
        if(Schema::hasTable('Guestbooks')){

        }
        else{
            Schema::create('Guestbooks', function (Blueprint $table) {
                $table->bigIncrements('Id');
                $table->string('Owner');
                $table->foreign('Owner')->references('Account')->on('Members');
                $table->string('Article');
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
