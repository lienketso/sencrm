<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->default(0); //Người dùng nhánh trên
            $table->string('code_name')->default(0); //Mã giới thiệu
            $table->string('affiliate')->nullable(); //mã người giới thiệu
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('fullname')->nullable();
            $table->string('passport')->nullable(); //Số chứng minh thư / hộ chiếu
            $table->string('address')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('gender',['male','female','other'])->default('other');
            $table->string('birthday')->nullable();
            $table->enum('status',['active','disable'])->default('disable');
            $table->integer('_left')->default(0);
            $table->integer('_right')->default(0);
            $table->string('token')->nullable();
            $table->integer('count_mem')->default(0); // Đếm thành viên trong nhánh max = 2
            $table->rememberToken();
            $table->timestamps();
        });
        //Reset password table
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
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
}
