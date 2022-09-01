<?php

namespace App\Modules\LigneCommande\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Produit\Models\Produit;
use App\Modules\User\Models\User;
use App\Modules\Commande\Models\Commande;

class LigneCommande extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function produit()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key');
        return $this->belongsTo(Produit::class,'produit_id','id');
    }
    public function user()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key');
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function commande()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key');
        return $this->belongsTo(Commande::class,'commande_id','id');
    }
    protected $fillable = [
        'qte',
        'produit_id',
        'user_id',
        'commande_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
