<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Liquidacion extends Model

{

    protected $table = "liquidaciones";

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
        'iduser', 'total', 'hash', 'wallet_used', 'process_date',
        'comment', 'comment2', 'comment_reverse', 'status', 'type_liquidation',
        'idinversion', 'monto_bruto', 'feed'
    ];



    public function user(){

        return $this->belongsTo('App\User');

    }

}
