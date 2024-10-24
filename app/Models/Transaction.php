<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'date',
        'description'
    ];

    /*
     * Связи
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /*
     * Фильтры
     */

    public function scopeByDate(Builder $query, string $start_date, string $end_date): void
    {
        $query->whereBetween('date', [$start_date, $end_date]);
    }
}
