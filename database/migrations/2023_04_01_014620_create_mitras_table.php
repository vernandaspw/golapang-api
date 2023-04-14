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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 40)->unique();
            $table->string('slug', 50);
            $table->string('logo', 50)->nullable();
            $table->decimal('saldo', 13,2 )->default(0);
            $table->decimal('saldo_kredit', 13,2)->default(0);
            $table->longText('deskripsi')->nullable();
            $table->enum('billing_status', ['free', 'premium'])->default('free');
            $table->timestamp('billing_expired_at')->nullable();
            $table->boolean('isaktif')->default(false);
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
        Schema::dropIfExists('mitras');
    }
};
