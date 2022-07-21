<?php

namespace App\Modules\Produit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Categorie\Models\Categorie;
class Produit extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
