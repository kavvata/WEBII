<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function resource(): BelongsToMany
    {
        // relacao varios para varios, nome da tabela pivot = permissions
        return $this->belongsToMany(Resource::class, 'permissions');
    }
}
