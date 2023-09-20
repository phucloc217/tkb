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
        Schema::create('monhoc_lop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tenmh', 30);
            $table->integer('sotiet')->nullable();
            $table->integer('conlai')->nullable();
            $table->char('malop', 10)->nullable()->index('malop');
            $table->integer('idgv')->index('a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monhoc_lop');
    }
};
