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
        Schema::create('olahragas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->string('slug', 40);
            $table->string('img', 80)->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('olahragas');
    }
};
