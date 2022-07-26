<?php

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
