<?php

namespace App\Modules\Picture\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\User;
use App\Modules\Produit\Models\Produit;

class Picture extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function Produit(){
        return $this->belongsTo(Produit::class,'picture_id');
    }

    protected $hidden = [
        'user_id',
        'Produit_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
