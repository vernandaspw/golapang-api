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
        Schema::create('iklan_kotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iklan_mitra_id')->constrained('iklan_mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kota_id')->constrained('kotas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('iklan_kotas');
    }
};
