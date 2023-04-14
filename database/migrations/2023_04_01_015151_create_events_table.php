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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('olahraga_id')->nullable()->constrained('olahragas')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama', 40);
            $table->foreignId('tempat_id')->nullable()->constrained('tempats')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('event_mulai');
            $table->timestamp('event_akhir');
            $table->enum('per', ['individu', 'tim']);
            $table->decimal('biaya', 12,2)->default(0);
            $table->integer('umur_start')->nullable();
            $table->integer('umur_end')->nullable();
            $table->enum('kategori', ['competitive', 'fun']);
            $table->bigInteger('max_kuota')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained('teams')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('events');
    }
};
