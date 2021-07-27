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
        if(Schema::hasTable('Responds')){

        }
        else{
            Schema::create('Responds', function (Blueprint $table) {
                $table->bigIncrements('Id');
                $table->unsignedBigInteger('ContentId');
                $table->foreign('ContentId')->references('Id')->on('Contents');
                $table->string('ReplyAccount');
                $table->foreign('ReplyAccount')->references('Account')->on('Members');
                $table->string('Reply');
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
