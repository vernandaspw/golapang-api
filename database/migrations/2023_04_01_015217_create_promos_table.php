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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->integer('kode')->unique();
            $table->string('img', 80)->nullable();
            $table->string('nama', 30);
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tempat_id')->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('olahraga_id')->nullable()->constrained('olahragas')->onUpdate('cascade')->onDelete('set null');
            $table->integer('min_jam')->default(1);
            $table->decimal('potongan', 10,2)->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_kuota');
            $table->integer('sisa_kuota');
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
        Schema::dropIfExists('promos');
    }
};
