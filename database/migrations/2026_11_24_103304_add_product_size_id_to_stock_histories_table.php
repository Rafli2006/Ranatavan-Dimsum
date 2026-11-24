<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('stock_histories', 'product_size_id')) {
            Schema::table('stock_histories', function (Blueprint $table) {
                $table->unsignedBigInteger('product_size_id')
                    ->nullable()
                    ->after('product_id');

                $table->foreign('product_size_id')
                    ->references('id')
                    ->on('product_sizes')
                    ->restrictOnDelete()
                    ->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('stock_histories', 'product_size_id')) {
            Schema::table('stock_histories', function (Blueprint $table) {
                $table->dropForeign(['product_size_id']);
                $table->dropColumn('product_size_id');
            });
        }
    }
};
