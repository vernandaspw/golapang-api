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
        Schema::create('tempat_latihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('olahraga_id')->nullable()->constrained('olahragas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('provinsi_id')->nullable()->constrained('provinsis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kota_id')->nullable()->constrained('kotas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('kecamatan', 25)->nullable();
            $table->longText('alamat_lokasi')->nullable();
            $table->string('nama', 40);
            $table->string('img', 80)->nullable();
            $table->string('cover1', 80)->nullable();
            $table->string('cover2', 80)->nullable();
            $table->string('cover3', 80)->nullable();
            $table->string('cover4', 80)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('link_group')->nullable();
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
        Schema::dropIfExists('tempat_latihans');
    }
};
