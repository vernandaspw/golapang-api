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
        Schema::create('tempat_latihan_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_latihan_id')->constrained('tempat_latihans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('img', 80)->nullable();
            $table->string('nama_anggota', 30)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('status', ['request', 'approve', 'nonactive']);
            $table->boolean('istampil')->default(true);
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
        Schema::dropIfExists('tempat_latihan_anggotas');
    }
};
