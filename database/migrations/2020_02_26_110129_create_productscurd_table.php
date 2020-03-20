<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductscurdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productscurd', function (Blueprint $table) {
            $table->bigIncrements('id');
//             $table->integer('category')->unsigned();
//              $table->integer('subcategory')->unsigned();
             $table->string('name');
            $table->longText('description');
            $table->string('image');
            $table->string('price');
            $table->string('colour');
            $table->date('start_date');
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
        Schema::dropIfExists('productscurd');
    }
}
