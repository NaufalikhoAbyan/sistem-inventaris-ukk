<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TRIGGER `barang_masuk_after_insert` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok + NEW.kuantitas_masuk
                WHERE barang.id = NEW.barang_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER `barang_masuk_after_update` AFTER UPDATE ON `barang_masuk` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok - OLD.kuantitas_masuk + NEW.kuantitas_masuk
                WHERE barang.id = NEW.barang_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER `barang_masuk_after_delete` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok - OLD.kuantitas_masuk
                WHERE barang.id = OLD.barang_id;
            END;
        ");

        DB::statement("
            CREATE TRIGGER `barang_keluar_after_insert` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok - NEW.kuantitas_keluar
                WHERE barang.id = NEW.barang_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER `barang_keluar_after_update` AFTER UPDATE ON `barang_keluar` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok + OLD.kuantitas_keluar - NEW.kuantitas_keluar
                WHERE barang.id = NEW.barang_id;
            END;
        ");
        DB::statement("
            CREATE TRIGGER `barang_keluar_after_delete` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN
                UPDATE barang
                SET stok = stok + OLD.kuantitas_keluar
                WHERE barang.id = OLD.barang_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS barang_masuk_after_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_masuk_after_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_masuk_after_update");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_keluar_after_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_keluar_after_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS barang_keluar_after_update");
    }
};
