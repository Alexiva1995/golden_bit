<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

 protected $fillable=[
    	'tickets_id','user_id','comentario'
    ];

 public function user(){
    	return $this->belongsTo('App\User');
    }

}