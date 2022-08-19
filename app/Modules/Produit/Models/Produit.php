<?php

namespace App\Modules\Produit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\User\Models\User;
use App\Modules\Picture\Models\Picture;
use App\Modules\Panier\Models\Panier;

class Produit extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    protected $primaryKey = 'id';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
     public function user()
    {
        return $this->belongsToMany(User::class,"user_produit")->withTimestamps();;
    }
    public function pictures()
    {
        return $this->hasMany(Picture::class,'Produit_id');
    }
    public function paniers(){
        return $this->belongsToMany(Panier::class,"produits_paniers")->withTimestamps();;
    }
    protected $fillable = [
        'name',
        'description',
        'stock',
        'prix',
        'categorie_id',
        'brand',

    ];

    protected $hidden = [
    ];


    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
