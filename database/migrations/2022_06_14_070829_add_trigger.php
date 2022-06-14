<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(" CREATE TRIGGER stok_masuk AFTER INSERT ON barang_masuks FOR EACH ROW BEGIN
        INSERT INTO barang_masuks (stok_masuk) VALUES (NEW.id) ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
