<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('perihal_surat');
            $table->string('no_urut');
            $table->string('kode_surat');
            $table->string('no_surat');
            $table->text('keterangan');
            $table->integer('tipe_surat');
            $table->integer('id_jenis');
            $table->text('file_surat')->nullable();
            $table->integer('status')->nullable();
            $table->text('ket_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
