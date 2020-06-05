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
            $table->string('code_name')->nullable();
            $table->integer('category')->unsigned()->nullable();
            $table->foreign('category')->references('id')->on('category')->onDelete('SET NULL');
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status',['active','disable','hot','new','sale'])->default('active');
            $table->enum('lang_code',['vi','en'])->default('vi');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->integer('views')->default(0);
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
