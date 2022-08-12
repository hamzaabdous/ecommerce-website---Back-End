<?php

namespace App\Modules\Commande\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Facture\Models\Facture;

class Commande extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function facture()
{
   return $this->hasOne(Facture::class);
}
    protected $fillable = [
        'status_commande',
        'mantant'
    ];

}
