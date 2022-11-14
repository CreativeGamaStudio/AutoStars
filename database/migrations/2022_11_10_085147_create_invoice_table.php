<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//database faktur
return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'invoice', function (Blueprint $table) {
                $table->id();
                $table->dateTime('invoice_date');
                //$table->float('total', 9, 20);
                $table->bigInteger('total');
                //  `lunas` int(11) NOT NULL default 0 COMMENT '0=belum,1=lunas',
                $table->integer('paid')->default(0)->comment('0=unpaid,1=paid');
                $table->timestamps();
            }
        );
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
};