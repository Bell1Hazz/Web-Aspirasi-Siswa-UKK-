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
    Schema::table('aspirasis', function (Blueprint $table) {
        $table->string('gambar')->nullable()->after('deskripsi'); 
        // kalau mau multi gambar nanti beda pendekatan (table terpisah)
    });
}

public function down()
{
    Schema::table('aspirasis', function (Blueprint $table) {
        $table->dropColumn('gambar');
    });
}

};
