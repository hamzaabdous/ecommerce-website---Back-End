<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProduitPanier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('produits_paniers', function (Blueprint $table) {
            $table->bigInteger('panier_id')->unsigned();

            $table->bigInteger('produit_id')->unsigned();

            $table->foreign('panier_id')->references('id')->on('paniers')

                ->onDelete('cascade');

            $table->foreign('produit_id')->references('id')->on('produits')

                ->onDelete('cascade');

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
