<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->tinyInteger('is_display')->default(0);
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->integer('order_id')->default(0);
            $table->string('name');
            $table->string('uri');
            $table->string('route_name');
            $table->string('description')->nullable();
            $table->string('wrap_group')->nullable();
            $table->string('wrap_group_level')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
