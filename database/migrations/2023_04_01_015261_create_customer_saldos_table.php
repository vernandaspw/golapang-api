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
        Schema::create('customer_saldos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->char('no', 18)->unique();
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->enum('kategori', ['isi', 'tarik', 'transfer', 'transaksi']);
            $table->decimal('nominal', 12,2)->default(0);
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('kode_unik', 6,2)->default(0);
            $table->decimal('fee', 8,2)->default(0);
            $table->decimal('fee_vendor', 8,2)->default(0);
            $table->decimal('total_pembayaran', 12, 2)->default(0);
            $table->decimal('income', 12, 2)->default(0);
            $table->enum('status', ['konfirm', 'proses', 'berhasil', 'gagal']);
            $table->enum('status_admin', ['konfirm', 'proses', 'proses_admin', 'berhasil', 'gagal']);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('konfirm_expired_at');
            $table->foreignId('bank_id')->nullable()->constrained('banks')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_rek', 40)->nullable();
            $table->string('norek', 40)->nullable();
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('transaksi_member_id')->nullable()->constrained('transaksi_members')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('customer_saldos');
    }
};
