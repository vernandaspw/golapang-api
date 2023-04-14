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
        Schema::create('iklan_mitras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tempat_id')->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('biaya_perhari', 12,2)->default(0);
            $table->integer('jml_hari');
            $table->decimal('total_biaya_perhari', 12,2)->default(0);

            $table->decimal('biaya_perprovinsi', 12,2)->default(0);
            $table->integer('jml_provinsi');
            $table->decimal('total_biaya_perprovinsi', 12,2)->default(0);

            $table->decimal('biaya_perkota', 12,2)->default(0);
            $table->integer('jml_kota');
            $table->decimal('total_biaya_perkota', 12,2)->default(0);

            $table->decimal('total_biaya', 12, 2);
            $table->timestamp('expired_at');
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
        Schema::dropIfExists('iklan_mitras');
    }
};
