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
            // Tambah username jika belum ada
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('name');
            }
            
            // Ganti 'name' dengan 'nama' jika belum
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'nama');
            }
            
            // Pastikan email tetap ada dan nullable
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique()->after('nama');
            }
            
            // Hapus email_verified_at karena tidak digunakan
            if (Schema::hasColumn('users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
            
            // Tambah role jika belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['siswa', 'admin'])->default('siswa')->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
