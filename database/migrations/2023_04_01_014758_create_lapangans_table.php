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
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->string('img', 80)->nullable();
            $table->foreignId('tempat_id')->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('olahraga_id')->constrained('olahragas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tipe_lapangan_id')->constrained('tipe_lapangans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('alas_lapangan_id')->constrained('alas_lapangans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('lapangans');
    }
};
