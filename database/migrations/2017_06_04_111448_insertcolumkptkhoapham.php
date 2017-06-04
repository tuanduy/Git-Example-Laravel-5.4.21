<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Insertcolumkptkhoapham extends Migration
{
    /**
     * Run the migrations.
     * File này dùng để thêm cột dữ liệu vào database
     * @return void
     */
    public function up()
    {
        Schema::table('kpt_khoapham',function($table)
      {
        $table->string('image');
      });
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
}
