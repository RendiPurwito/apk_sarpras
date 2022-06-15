<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER masuk_stock AFTER INSERT ON barang_masuks
        FOR EACH ROW
        BEGIN UPDATE barangs SET 
        stok_barang = stok_barang + NEW.stok_masuk
        WHERE id = id;
        END
        ');

        DB::unprepared('CREATE TRIGGER keluar_stock AFTER INSERT ON barang_keluars
        FOR EACH ROW
        BEGIN UPDATE barangs SET 
        stok_barang = stok_barang - NEW.jumlah_barang
        WHERE id = id;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER masuk_stock');
    }
};
