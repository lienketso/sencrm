<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mail', function (Blueprint $table) {
            $table->enum('type', [
                'booster_to_admin', 'booster_to_custommer', 'instructions', 'order_complete', 'order_to_admin',
                'order_to_custommer'
            ])->after('content')->default('booster_to_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
