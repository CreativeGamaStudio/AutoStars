<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//database nota bengkel
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->integer('price');
            $table->integer('flag')->default(0)->comment('0=unreturn,1=return');
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
        Schema::dropIfExists('note_detail');
    }
};
