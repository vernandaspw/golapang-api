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
        Schema::create('mitra_saldo_kredits', function (Blueprint $table) {
            $table->id();
            $table->char('no', 18)->unique();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('mitra_user_id')->nullable()->constrained('mitras')->onUpdate('cascade')->onDelete('set null');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->enum('kategori', ['isi', 'fee', 'transfer']);
            $table->decimal('nominal', 13,2)->default(0);
            $table->enum('status', ['proses', 'berhasil', 'gagal']);
            $table->foreignId('mitra_saldo_id')->nullable()->constrained('mitra_saldos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('transaksi_member_id')->nullable()->constrained('transaksi_members')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('iklan_mitra_id')->nullable()->constrained('iklan_mitras')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('billing_transaksi_id')->nullable()->constrained('billing_transaksis')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('mitra_saldo_kredits');
    }
};
