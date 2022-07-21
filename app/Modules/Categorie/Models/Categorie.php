<?php

namespace App\Modules\Categorie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Produit\Models\Produit;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
