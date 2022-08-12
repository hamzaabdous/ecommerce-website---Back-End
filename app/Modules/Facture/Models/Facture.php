<?php

namespace App\Modules\Facture\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Commande\Models\Commande;

class Facture extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function commande()
    {
       return $this->belongsTo(Commande::class);
    }

    protected $fillable = [
        'mantant',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
