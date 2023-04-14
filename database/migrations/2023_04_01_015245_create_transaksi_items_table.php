<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lapangan_harga')->nullable()->constrained('lapangan_hargas')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal')->nullable();
            $table->string('hari', 10)->nullable();
            $table->time('jam')->nullable();
            $table->decimal('diskon_persen', 4,2)->default(0);
            $table->decimal('harga_awal', 12, 2)->default(0);
            $table->decimal('harga', 12,2)->default(0);
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
        Schema::dropIfExists('transaksi_items');
    }
};
