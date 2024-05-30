<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => MoneyCast::class, // bikin field price jadi money
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class); // banyak treatment punya 1 patient
    }
}
