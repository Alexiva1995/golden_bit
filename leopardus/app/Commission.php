<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Commission extends Model

{
    protected $table = "commissions";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'compra_id', 'date', 'total', 'referred_email', 'referred_level', 'status', 'concepto'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}