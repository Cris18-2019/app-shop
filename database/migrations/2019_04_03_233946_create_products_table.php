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
            $table->String('name');
            $table->String('description');
            $table->text('long_description')->nullable();
            /*###########################################*/
    /*Creando una llave foranea, primero se declara el nombre de la columna 
    Este campo podra no ser asociado a una categoria*/
            $table->unsignedBigInteger('category_id')->nullable();
    /*Y luego se declara que actuara como llave foranea*/        
            $table->foreign('category_id')->references('id')->on('categories');
             /*##########################################*/

            $table->float('price');
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
        Schema::dropIfExists('products');
    }
}
