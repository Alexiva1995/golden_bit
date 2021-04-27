<?php

namespace Modules\ReferralTree\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'webp_users';
    protected $primaryKey = 'ID';
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'password',
        'avatar', 'provider_id', 'provider', 'id', 'name',
        'access_token', 'created_at', 'updated_at', 'referred_id'
    ];

    protected $appends = ['description'];

    public function getDescriptionAttribute()
    {
        return $this->display_name;
    }

    public function children()
    {
        return $this->hasMany(User::class, 'referred_id', 'ID');
    }

}
