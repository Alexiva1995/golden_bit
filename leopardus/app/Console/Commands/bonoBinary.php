<?php

namespace App\Console\Commands;

use App\Http\Controllers\ComisionesController;
use Carbon\Carbon;
use Illuminate\Console\Command;

class bonoBinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:binary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite pagar el bono binario';

    public $comisionController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comisionController = new ComisionesController();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comisionController->bonoBinario();

        $this->info('Bono Binario Pagado '. Carbon::now());
    }
}
