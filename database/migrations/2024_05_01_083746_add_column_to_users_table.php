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
        Schema::table('users', function (Blueprint $table) {

            $table->string('image')->default('/gambar/pengguna/avatar.png');
            $table->string('username')->unique()->nullable();
            $table->enum('role',['internal', 'eksternal'])->default('internal');
            $table->string('idnumber')->unique()->nullable();
            $table->string('instansi')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('jabatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
