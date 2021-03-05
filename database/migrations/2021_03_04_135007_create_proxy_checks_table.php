<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxyChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('check_id');
            $table->string('proxy');
            $table->string('type');
            $table->string('location');
            $table->string('status');
            $table->string('timeout');
            $table->string('real_ip');
            $table->float('time_checked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxy_checks');
    }
}
