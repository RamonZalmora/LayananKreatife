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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            // Relasi user
            $table->unsignedBigInteger('user_id');

            // Jenis transaksi
            $table->enum('type', ['income', 'expense']);

            // Judul keterangan transaksi
            $table->string('title');

            // Jumlah uang
            $table->decimal('amount', 15, 2);

            // Kategori (opsional)
            $table->string('category')->nullable();

            // Tanggal transaksi
            $table->date('date');

            // Catatan (opsional)
            $table->text('note')->nullable();

            // File bukti (foto struk)
            $table->string('receipt')->nullable();

            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
