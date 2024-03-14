<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Declaracao extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'declaracoes';

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function comprovante(): BelongsTo
    {
        return $this->belongsTo(Comprovante::class);
    }
}
