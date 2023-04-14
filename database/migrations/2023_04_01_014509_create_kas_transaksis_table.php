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
        Schema::create('kas_transaksis', function (Blueprint $table) {
            $table->id();
            $table->char('no', 18)->unique();
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->foreignId('kas_id')->constrained('kas')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('nominal', 12,2)->default(0);
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('kas_transaksis');
    }
};
