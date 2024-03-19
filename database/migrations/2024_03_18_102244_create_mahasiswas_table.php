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
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            // $table->id();
            // //field id
            $table->integer('id')->autoIncrement();
            //field npm
            $table->char('npm', 8);
            //field nama
            $table->String("nama", 100);
            //field telpon
            $table->String("telpon", 15);
            //field jurusan
            $table->enum("jurusan", ["IF","SI","TI","TK","SIA"]);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
