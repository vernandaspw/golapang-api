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
        Schema::create('billing_transaksis', function (Blueprint $table) {
            $table->id();
            $table->char('no', 18)->unique();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('hari')->default(0);
            $table->decimal('harga', 10,2);
            $table->decimal('diskon_persen', 4,2)->default(0);
            $table->decimal('diskon', 10, 2)->default(0);
            $table->decimal('total', 10,2);
            $table->enum('status_bayar', ['pending', 'success', 'failed']);
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
        Schema::dropIfExists('billing_transaksis');
    }
};
