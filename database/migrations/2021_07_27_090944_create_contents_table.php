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
        if(Schema::hasTable('Contents')){

        }
        else{
            Schema::create('Contents', function (Blueprint $table) {
                $table->bigIncrements('Id');
                $table->unsignedBigInteger('GuestId');
                $table->foreign('GuestId')->references('Id')->on('Guestbooks');
                $table->string('DetailAccount');
                $table->foreign('DetailAccount')->references('Account')->on('Members');
                $table->string('Detail');
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
