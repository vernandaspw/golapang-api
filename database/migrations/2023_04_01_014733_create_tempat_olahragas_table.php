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
        Schema::create('tempat_olahragas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempat_id')->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('olahraga_id')->constrained('olahragas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tempat_olahragas');
    }
};
