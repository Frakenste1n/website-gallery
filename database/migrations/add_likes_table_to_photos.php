<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Buat tabel likes
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('photo_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Memastikan user hanya bisa like sekali
            $table->unique(['user_id', 'photo_id']);
        });

        // Tambahkan kolom likes ke tabel photos jika belum ada
        if (!Schema::hasColumn('photos', 'likes')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->integer('likes')->default(0);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('likes');

        if (Schema::hasColumn('photos', 'likes')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->dropColumn('likes');
            });
        }
    }
}; 