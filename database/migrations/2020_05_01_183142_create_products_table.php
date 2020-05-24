<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('description');
            $table->text('long_description')->nullable();//text cuando la extension es mayor
            $table->float('price');
            $table->integer('stock')->default(0);

            //clave foranea
            $table->unsignedBigInteger('category_id')->nullable();//columna que nos va a servir como id de la relacion como tal
            $table->foreign('category_id')->references('id')->on('categories');//relacion como tal

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
