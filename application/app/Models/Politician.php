<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Politician extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'canton_id' => 'integer',
        'faction_id' => 'integer',
        'council_id' => 'integer',
    ];

    public function canton(): BelongsTo
    {
        return $this->belongsTo(Canton::class);
    }

    public function faction(): BelongsTo
    {
        return $this->belongsTo(Faction::class);
    }

    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class);
    }
}
