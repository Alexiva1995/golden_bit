<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'notification_type', 'date', 'route', 'description', 'icon', 'label', 'status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
