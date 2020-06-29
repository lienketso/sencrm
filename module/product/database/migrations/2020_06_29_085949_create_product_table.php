<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('code_name')->nullable(); //mã sản phẩm
            $table->string('weight')->nullable(); //Trọng lượng
            $table->string('unit')->nullable(); //Đơn vị tính
            $table->double('price')->default(0); //Giá niêm yết
            $table->double('discount')->default(0);
            $table->text('excerpt')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status',['active','disable'])->default('active');
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
        Schema::dropIfExists('product');
    }
}
