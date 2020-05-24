<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //crea la tabla categories
        //por defecto los campos se crean not null
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('description')->nullable();//opcional, puede ser null
            $table->string('image')->nullable();//opcional, puede ser null
            
            $table->timestamps();//crea created_at y update_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations o rollback
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
