<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function comprovantes(): HasMany
    {
        return $this->hasMany(Comprovante::class);
    }
}
