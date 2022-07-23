<?php

namespace App\Modules\Produit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Categorie\Models\Categorie;
use App\Modules\User\Models\User;

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
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'stock',
        'prix',
        'categorie_id'

    ];

    protected $hidden = [
        'user_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
