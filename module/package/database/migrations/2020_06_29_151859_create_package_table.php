<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->double('price')->default(0); //Giá trị gói
            $table->integer('is_order')->default(0); //Thứ tự sắp xếp
            $table->string('type')->default('product'); //Thứ tự sắp xếp
            $table->enum('status',['active','disable'])->default('active'); //Trạng thái hiển thị
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
        Schema::dropIfExists('package');
    }
}
