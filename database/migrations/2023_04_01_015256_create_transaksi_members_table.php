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
        Schema::create('transaksi_members', function (Blueprint $table) {
            $table->id();
            $table->char('no', 18)->unique();
            $table->enum('tipe', ['bycustomer', 'bymitra']);
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onUpdate('cascade')->onDelete('set null');
            $table->string('customer_nama', 30)->nullable();
            $table->foreignId('team_id')->nullable()->constrained('teams')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('mitra_user_id')->nullable()->constrained('mitra_users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('mitra_id')->nullable()->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tempat_id')->nullable()->constrained('tempats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lapangan_id')->nullable()->constrained('lapangans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('olahraga_id')->nullable()->constrained('olahragas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lapangan_harga_member_id')->nullable()->constrained('lapangan_harga_members')->onUpdate('cascade')->onDelete('cascade');
            $table->string('hari', 10)->nullable();
            $table->string('waktu', 10)->nullable();
            $table->time('waktu_start');
            $table->time('waktu_end');
            $table->decimal('diskon_persen', 4,2)->default(0);
            $table->decimal('harga_awal', 12, 2)->default(0);
            $table->decimal('harga', 12,2)->default(0);
            $table->integer('kuota_main')->default(0);
            $table->integer('kuota_sisa')->default(0);
            $table->timestamp('masa_berlaku');
            $table->decimal('fee_customer', 9,2)->default(0);
            $table->decimal('fee_mitra', 9,2)->default(0);
            $table->decimal('fee_vendor', 9,2)->default(0);
            $table->decimal('total_pembayaran', 12, 2)->default(0);
            $table->decimal('income', 12, 2)->default(0);
            // $table->foreignId('customer_saldo_id')->nullable()->constrained('customer_saldos')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('mitra_saldo_id')->nullable()->constrained('mitra_saldos')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('mitra_saldo_kredit_id')->nullable()->constrained('mitra_saldo_kredits')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status_bayar', ['lunas', 'dp'])->default('lunas');
            $table->enum('status_customer', ['aktif', 'selesai', 'batal'])->default('aktif');
            $table->enum('status', ['tidak', 'sedang', 'selesai', 'batal']);
            $table->foreignId('ulasan_id')->nullable()->constrained('ulasans')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('transaksi_members');
    }
};
