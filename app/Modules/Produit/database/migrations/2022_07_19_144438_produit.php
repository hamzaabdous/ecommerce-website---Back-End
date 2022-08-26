<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("description");
            $table->string("brand");
            $table->string("src")->default("")->nullable();
            $table->integer("stock");
            $table->float('prix', 50, 2);
            $table->bigInteger('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');


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
        //
    }
}
