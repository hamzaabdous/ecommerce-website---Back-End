<?php

namespace App\Modules\Role\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $role = new Role();
         $role->name='admin';
         $role = new Role();
         $role->name='client';
         $role->save();
    }
}

