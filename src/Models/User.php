<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** User has many Addresses
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(\Src\Models\Address::class);
    }

}
