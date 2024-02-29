<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
        'short_name',
        'created_at',
        'updated_at'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($state){
            $state->cities()->delete();
        });
    }

    /** State has many Cities
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(\Src\Models\City::class);
    }

}
