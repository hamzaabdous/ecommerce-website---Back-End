<?php

namespace App\Modules\Categorie\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Categorie\Models\Categorie;

class Categorieseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = new Categorie();
         $categorie->name='Books';
         $categorie->description='a written or printed work consisting of pages glued or sewn together along one side and bound in covers. ';
         $categorie->save();
         $categorie = new Categorie();
         $categorie->name='Fashion';
         $categorie->description='the prevailing style (as in dress) during a particular time The spring fashions are now on display';
         $categorie->save();

    }
}

