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
        Schema::create('usulan_ujikoms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('jenis_ujikom_id');
            $table->foreign('jenis_ujikom_id')->references('id')->on('jenis_ujikoms')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('ujikom_id');
            $table->foreign('ujikom_id')->references('id')->on('ujikoms')->onDelete('restrict')->onUpdate('restrict');
            $table->string('usulan_lainnya')->nullable();
            $table->enum('status',['Validasi','Belum Validasi'])->default('Belum Validasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_ujikoms');
    }
};
