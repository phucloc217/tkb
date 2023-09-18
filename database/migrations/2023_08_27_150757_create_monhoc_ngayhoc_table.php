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
        Schema::create('monhoc_ngayhoc', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('ngayhoc')->nullable();
            $table->integer('id_monhoc')->nullable()->index('id_monhoc');
            $table->integer('maphong')->nullable()->index('maphong');
            $table->dateTime('start');
            $table->dateTime('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monhoc_ngayhoc');
    }
};
