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
        Schema::create('mitra_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('mitra_id')->constrained('mitras')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tempat_id')->nullable()->constrained('mitras')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama', 30);
            $table->string('img', 80)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('phone', 18)->unique();
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 65);
            $table->enum('role', ['pemilik', 'admin', 'operator'])->default('pemilik');
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
        Schema::dropIfExists('mitra_users');
    }
};
