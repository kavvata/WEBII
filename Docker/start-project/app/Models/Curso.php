<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function eixo(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Eixo');
    }

    public function nivel(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Nivel');
    }

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }

    public function categorias(): HasMany
    {
        return $this->hasMany(Categoria::class);
    }
}
