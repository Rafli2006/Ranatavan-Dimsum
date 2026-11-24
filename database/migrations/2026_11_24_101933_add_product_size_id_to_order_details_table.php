<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom dan foreign key sudah tersedia di database.
        // Tidak perlu menambahkan ulang.
    }

    public function down(): void
    {
        // Tidak menghapus struktur yang sudah ada.
    }
};