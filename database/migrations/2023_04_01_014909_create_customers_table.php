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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('nama', 30);
            $table->string('img', 80)->nullable();
            $table->string('phone', 18)->unique();
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 65);
            $table->decimal('saldo', 12,2)->default(0);
            $table->decimal('poin', 12,2)->default(0);
            $table->char('kode_refferal', 8)->nullable();
            $table->foreignId('refferal_id')->nullable()->constrained('customers')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('provinsi_id')->nullable()->constrained('provinsis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kota_id')->nullable()->constrained('kotas')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tgl_lahir')->nullable();
            $table->boolean('isaktif')->default(true);
            $table->string('google_id', 25)->nullable();
            $table->string('code', 65)->nullable();
            $table->timestampTz('code_expired_at')->nullable();
            $table->timestampTz('code_resend_at')->nullable();
            $table->timestampTz('last_seen_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
};
