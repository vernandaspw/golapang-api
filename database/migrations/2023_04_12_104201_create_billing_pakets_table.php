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
        Schema::create('billing_pakets', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30)->nullable();
            $table->integer('hari')->default(0);
            $table->decimal('diskon_persen', 4,2)->default(0);
            $table->decimal('harga', 10,2)->default(0);
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
        Schema::dropIfExists('billing_pakets');
    }
};
