<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//database pembayaran bengkel / bukti bayar
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->integer('price'); //jumlah bayar
            $table->integer('discount'); //jumlah diskon
            $table->dateTime('date');//tanggal pembayaran
            $table->string('card_number'); //nomor kartu
            $table->string('giro_number'); //nomor giro
            $table->timestamps();
        });

        Schema::create('payment_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('cost'); //jumlah bayar
            $table->integer('discount'); //jumlah diskon
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
        Schema::dropIfExists('payment');
    }
};
