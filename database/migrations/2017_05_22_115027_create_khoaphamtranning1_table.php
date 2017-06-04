<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhoaphamtranning1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // Trình sẽ chạy lần đầu tiên để tạo bảng
    {
        Schema::create('khoaphamtranning1', function (Blueprint $table) {
            $table->increments('id');//
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // Nếu bảng đã tồn tại thì xóa bảng và tạo lại
    {
        Schema::dropIfExists('khoaphamtranning1');
    }
}
