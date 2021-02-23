<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\ActivacionController;

class StatusUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar el estado de los usuario';

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
            $users = User::where([
                ['status', '=', 0],
                ['ID', '!=', 1]
            ])->get();
            $activacion = new ActivacionController;
            foreach ($users as $user ) {
                $activacion->activarUsuarios($user->ID);
            }
            $this->info('Usuarios Verificados Correctamente '.Carbon::now());
        } catch (\Throwable $th) {
            $this->info($th);
        }
    }
}
