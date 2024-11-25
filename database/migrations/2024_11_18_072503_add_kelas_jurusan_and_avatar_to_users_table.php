<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('avatar')->nullable(); // Tambahkan kolom avatar di sini
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['kelas', 'jurusan', 'avatar']); // Hapus kolom avatar saat rollback
        });
    }
    

};
