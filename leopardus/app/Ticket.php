<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

 protected $fillable=[
    	'titulo','comentario','user_id','admin','status'
    ];

 public function user(){
    	return $this->belongsTo('App\User');
    }

}