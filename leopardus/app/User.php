<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hexters\CoinPayment\Entities\CoinPaymentuserRelation;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = "wp_users";
    protected $primaryKey = 'ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'birthdate', 'gender', 'user_login', 'user_pass', 'user_nicename',
        'user_email', 'user_url', 'user_registered', 'user_activation_key', 'user_status',
        'display_name', 'password', 'avatar', 'access_token', 'referred_id',
        'sponsor_id', 'position_id', 'status', 'rol_id', 'wallet_amount',
        'clave', 'activacion', 'token_correo', 'verificar_correo', 'toke_google',
        'tipouser', 'puntos', 'paquete', 'puntosP', 'puntosizq',
        'puntosder', 'ladomatrix', 'ladoregistrar', 'icono_paquete', 'clave_maestra',
        'fecha_activacion', 'rentabilidad', 'porc_rentabilidad', 'check_token_google'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
  public function scopeSearch($query, $user_email){
         $query->where(DB::raw("CONCAT(ID)"),"LIKE" ,"%$user_email%");
   

    }


    public function referrals()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function commissions(){
        return $this->hasMany('App\Commission');
    }

    public function transfers(){
        return $this->hasMany('App\Transfer');
    }
    
    public function tickets(){
        return $this->hasMany('App\Ticket');
        
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
        
    }
}
