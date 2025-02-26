<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id("id_pembayaran");
            $table->integer("id_user");
            $table->string("nisn");
            $table->date("tgl_bayar");
            $table->string("bulan_bayar");
            $table->string("tahun_bayar");
            $table->integer("jumlah_bayar");
            $table->integer("uang_sisa");
            $table->string("status");
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};