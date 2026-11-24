<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('name', 30);
            $table->string('unit', 20);
            $table->unsignedTinyInteger('piece_count')->nullable();

            $table->decimal('price', 12, 2);
            $table->unsignedInteger('stock')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['product_id', 'name']);
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->foreignId('product_size_id')
                ->nullable()
                ->after('product_id')
                ->constrained('product_sizes')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['product_size_id']);
            $table->dropColumn('product_size_id');
        });

        Schema::dropIfExists('product_sizes');
    }
};
