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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('pajak_customer', 4, 2)->default(0)->nullable();
            $table->decimal('pajak_mitra', 4, 2)->default(0)->nullable();
            $table->decimal('fee_customer_topup', 10, 2)->default(0)->nullable();
            $table->decimal('fee_customer_tarik', 10, 2)->default(0)->nullable();
            $table->decimal('fee_mitra_topup', 10, 2)->default(0)->nullable();
            $table->decimal('fee_mitra_tarik', 10, 2)->default(0)->nullable();

            $table->decimal('fee_customer_transaksi', 10, 2)->default(0)->nullable();
            $table->decimal('fee_customer_transaksi_member', 10, 2)->default(0)->nullable();
            $table->decimal('fee_mitra_transaksi', 10, 2)->default(0)->nullable();
            $table->decimal('fee_mitra_transaksi_member', 10, 2)->default(0)->nullable();

            $table->decimal('min_isi_customer', 10, 2)->default(0);
            $table->decimal('max_isi_customer', 10, 2)->default(0);
            $table->decimal('min_tarik_customer', 10, 2)->default(0);
            $table->decimal('max_tarik_customer', 10, 2)->default(0);

            $table->decimal('min_isi_mitra', 10, 2)->default(0);
            $table->decimal('max_isi_mitra', 10, 2)->default(0);
            $table->decimal('min_tarik_mitra', 10, 2)->default(0);
            $table->decimal('max_tarik_mitra', 10, 2)->default(0);

            $table->decimal('biaya_iklan_perhari', 10, 2)->default(0);
            $table->decimal('biaya_iklan_perprovinsi', 10, 2)->default(0);
            $table->decimal('biaya_iklan_perkota', 10, 2)->default(0);

            $table->decimal('min_saldo_kredit_mitra', 10, 2)->default(0);

            $table->boolean('admin_password')->default(true);
            $table->boolean('admin_otp_wa')->default(true);
            $table->boolean('admin_otp_email')->default(true);

            $table->boolean('mitra_password')->default(true);
            $table->boolean('mitra_otp_wa')->default(true);
            $table->boolean('mitra_otp_email')->default(true);

            $table->boolean('customer_password')->default(true);
            $table->boolean('customer_otp_wa')->default(true);
            $table->boolean('customer_otp_email')->default(true);

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
        Schema::dropIfExists('settings');
    }
};
