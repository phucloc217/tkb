<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->date('ngaysinh')->nullable();
            $table->char('hocham', 5)->nullable()->default('K');
            $table->char('hocvi', 5)->nullable()->default('CN');
            $table->char('sdt', 11)->nullable();
            $table->string('diachi')->nullable();
            $table->string('email')->unique();
            $table->string('anh')->nullable()->default('team-1.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        // DB::table('users')->insert(
        //     array(
        //         'name' => 'Nguyễn Phúc Lộc',
        //         'ngaysinh' => '2001-07-21',
        //         'sdt'=>'0384731507',
        //         'email'=>'loc.nguyen456789@gmail.com',
        //         'password'=>Hash::make('21072001')
        //     )
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
