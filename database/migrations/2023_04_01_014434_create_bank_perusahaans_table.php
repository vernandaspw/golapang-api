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
        Schema::create('bank_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 40);
            $table->string('img', 80)->nullable();
            $table->string('an', 25)->nullable();
            $table->string('norek', 40)->nullable();
            $table->longText('keterangan')->nullable();
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onUpdate('cascade')->onDelete('set null');
            $table->boolean('isaktif')->default(true);
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
        Schema::dropIfExists('bank_perusahaans');
    }
};
