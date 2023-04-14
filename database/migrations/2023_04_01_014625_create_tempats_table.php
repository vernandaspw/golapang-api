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
        Schema::create('tempats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama', 40)->unique();
            $table->string('slug', 50);
            $table->longText('deskripsi')->nullable();
            $table->string('img1', 80)->nullable();
            $table->string('img2', 80)->nullable();
            $table->string('img3', 80)->nullable();
            $table->string('img4', 80)->nullable();
            $table->string('img5', 80)->nullable();
            $table->foreignId('provinsi_id')->nullable()->constrained('provinsis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kota_id')->nullable()->constrained('kotas')->onUpdate('cascade')->onDelete('set null');
            $table->string('kecamatan', 20)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('telp', 18)->nullable();
            $table->longText('link_gmap')->nullable();
            $table->longText('iframe_gmaps')->nullable();
            $table->string('lat', 20)->nullable();
            $table->string('long', 20)->nullable();
            $table->boolean('isopen')->default(true);
            $table->boolean('isaktif')->default(true);
            $table->boolean('isutama')->default(false);
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
        Schema::dropIfExists('tempats');
    }
};
