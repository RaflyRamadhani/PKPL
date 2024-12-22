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
        Schema::table('categories', function (Blueprint $table) {
            // Menambahkan kolom price jika belum ada
            if (!Schema::hasColumn('categories', 'price')) {
                $table->decimal('price', 8, 2)->after('category_name'); // Menambahkan kolom price
            }

            // Menambahkan kolom stock jika belum ada
            if (!Schema::hasColumn('categories', 'stock')) {
                $table->integer('stock')->after('price'); // Menambahkan kolom stock
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Menghapus kolom price dan stock jika rollback
            if (Schema::hasColumn('categories', 'price')) {
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('categories', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};
