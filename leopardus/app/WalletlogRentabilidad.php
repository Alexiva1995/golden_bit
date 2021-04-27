<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletlogRentabilidad extends Model
{
    //
    protected $table = 'walletlog_rentabilidad';

    protected $fillable = [
        'iduser', 'concepto', 'debito', 'credito', 'balance',
        'semana', 'year', 'fecha_pago', 'fecha_retiro', 'descuento',
        'idinversion'
    ];
}
