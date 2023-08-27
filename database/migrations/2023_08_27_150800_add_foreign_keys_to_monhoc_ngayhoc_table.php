<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('monhoc_ngayhoc', function (Blueprint $table) {
            $table->foreign(['maphong'], 'monhoc_ngayhoc_ibfk_1')->references(['id'])->on('phonghoc')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_monhoc'], 'monhoc_ngayhoc_ibfk_2')->references(['id'])->on('monhoc_lop')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monhoc_ngayhoc', function (Blueprint $table) {
            $table->dropForeign('monhoc_ngayhoc_ibfk_1');
            $table->dropForeign('monhoc_ngayhoc_ibfk_2');
        });
    }
};
