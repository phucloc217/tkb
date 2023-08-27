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
        Schema::table('monhoc_lop', function (Blueprint $table) {
            $table->foreign(['malop'], 'monhoc_lop_ibfk_1')->references(['id'])->on('lophoc')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['idgv'], 'monhoc_lop_ibfk_2')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monhoc_lop', function (Blueprint $table) {
            $table->dropForeign('monhoc_lop_ibfk_1');
            $table->dropForeign('monhoc_lop_ibfk_2');
        });
    }
};
