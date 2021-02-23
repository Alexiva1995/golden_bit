<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'referidos', 'refeact', 'referidosd', 'compras', 'grupal', 
        'comisiones', 'bonos', 'niveles', 'rolprevio', 'acepta_comision', 'paquete', 'rolnecesario', 'imagen'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}

