<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'state_id',
        'name',
        'short_name',
        'created_at',
        'updated_at',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($city){
            $city->addresses()->delete();
        });
    }

    /** City belongs to State
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(\Src\Models\State::class);
    }

    /** City has many Addresses
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(\Src\Models\Address::class);
    }

}
