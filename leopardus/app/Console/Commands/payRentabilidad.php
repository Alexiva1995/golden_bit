<?php

namespace App\Console\Commands;

use App\Http\Controllers\ComisionesController;
use Carbon\Carbon;
use Illuminate\Console\Command;

class payRentabilidad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:Rentabilidad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite pagar la rentabilidad de los paquetes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $comi = new ComisionesController();
            $comi->pagarRentabilidad();
            $this->info('Rentabilidad pagada '.Carbon::now());
        } catch (\Throwable $th) {
            $this->info($th);
        }
    }
}