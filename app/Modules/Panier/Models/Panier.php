<?php

namespace App\Modules\Panier\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\User;

class Panier extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function user()
    {
        return $this->belongsTo(User::class,"id");
    }

    protected $fillable = [
        'prixTotal',
        'user_id'
    ];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];}
