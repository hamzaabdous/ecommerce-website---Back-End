<?php

namespace App\Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Modules\Role\Models\Role;
use App\Modules\Picture\Models\Picture;
use App\Modules\Produit\Models\Produit;
use App\Modules\Panier\Models\Panier;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=["id"];
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function picture(){
      //  return $this->belongsTo(Picture::class);
        return $this->hasMany(Picture::class);
    }
    public function produits(){
          return $this->belongsToMany(Produit::class,"user_produit")->withTimestamps();;
      }
      public function panier()
      {
          return $this->hasOne(Panier::class,"user_id");
      }
    protected $fillable = [
        'username',
        "lastName",
        'firstName',
        'phoneNumber',
        'email',
        'password',
        'role_id',
        'city',
        'codePostal',
        'genre',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}
