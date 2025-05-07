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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('categori_id');
            $table->foreign('categori_id')->references('id')->on('categories')->onDelete('cascade');
            //foreign : kolom category_id akan merujuk ke kolom id di tabel lain (dalam hal ini categories).
            //references : Menunjukkan bahwa category_id akan merujuk ke kolom id di tabel yang ditentukan.
            //on : Menunjukkan bahwa kolom category_id merujuk ke tabel categories.
            //onDelete('cascade') : 'cascade': Jika sebuah kategori dihapus dari tabel categories, maka semua data yang memiliki category_id tersebut juga akan ikut dihapus otomatis dari tabel ini (tabel relasi/anak).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
