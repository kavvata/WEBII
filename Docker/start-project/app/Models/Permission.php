<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    private static $keys = ['role_id', 'resource_id'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public static function getKeys(): array
    {
        return self::$keys;
    }
}
