<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class); // banyak treatment punya 1 owner
    }

    public function treatments(): HasMany{
        return $this->hasMany(Treatment::class); // 1 patient punya banyak treatment atau (one to many)
    }
}
