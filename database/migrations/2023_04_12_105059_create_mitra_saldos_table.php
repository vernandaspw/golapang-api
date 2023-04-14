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
        Schema::create('mitra_saldos', function (Blueprint $table) {
            $table->id();
            $table->char('no', 18)->unique();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('mitra_user_id')->nullable()->constrained('mitras')->onUpdate('cascade')->onDelete('set null');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->enum('kategori', ['isi', 'tarik', 'transfer']);
            $table->decimal('nominal', 13,2)->default(0);
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('kode_unik', 6,2)->default(0);
            $table->decimal('fee', 9,2)->default(0);
            $table->decimal('fee_vendor', 9,2)->default(0);
            $table->decimal('total_pembayaran', 13,2)->default(0);
            $table->decimal('income', 13,2)->default(0);
            $table->enum('status', ['konfirm', 'proses', 'berhasil', 'gagal']);
            $table->enum('status_admin', ['konfirm', 'proses', 'proses_admin', 'berhasil', 'gagal']);
            $table->timestamp('konfirm_expired_at')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('bank_id')->nullable()->constrained('banks')->onUpdate('cascade')->onDelete('set null');
            $table->string('an', 30)->nullable();
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
        Schema::dropIfExists('mitra_saldos');
    }
};
