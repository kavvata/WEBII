<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public function role(): BelongsToMany
    {
        // relacao varios para varios, nome da tabela pivot = permissions
        return $this->belongsToMany(Role::class, 'permissions');
    }
}
