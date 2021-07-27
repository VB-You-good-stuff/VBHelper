<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('Members')){

        }
        else{
            Schema::create('Members', function (Blueprint $table) {
                $table->bigIncrements('Id');
                $table->string('Account')->comment('學生帳號');
                $table->string('Password')->comment('學生密碼');
                $table->string('Name')->comment('學生名稱');
                $table->string('Email',30)->comnent('信箱');
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
        Schema::dropIfExists('members');
    }
}
