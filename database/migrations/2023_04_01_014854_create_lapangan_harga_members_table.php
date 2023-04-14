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
        Schema::create('lapangan_harga_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lapangan_id')->constrained('lapangans')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kuota_main_sebulan');
            $table->enum('waktu', ['pagi', 'siang', 'sore', 'malam']);
            $table->time('waktu_awal');
            $table->time('waktu_akhir');
            $table->decimal('diskon_persen', 4, 2)->default(0);
            $table->decimal('harga')->default(0);
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
        Schema::dropIfExists('lapangan_harga_members');
    }
};
