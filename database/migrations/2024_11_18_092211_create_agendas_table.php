<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_agenda');
            $table->date('tgl_agenda');
            $table->string('lokasi');
            $table->text('deskripsi_agenda');
            $table->timestamps();
        });
    }   

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
 