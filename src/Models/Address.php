<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'city_id',
        'address',
        'number',
        'postal_code',
        'description',
        'created_at',
        'updated_at',
    ];

    /** Address belongs to User
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\Src\Models\User::class);
    }

    /** Address belongs to City
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(\Src\Models\City::class);
    }

}
