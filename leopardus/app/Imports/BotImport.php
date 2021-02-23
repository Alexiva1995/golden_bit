<?php

namespace App\Imports;

use App\Botbrainbow;
use App\Http\Controllers\BotBrainbowController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BotImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row['id'])) {
            $validate = Validator::make($row, [
                'fecha' => ['required'],
                'hora' => ['required'],
                'abierto' => ['required', 'numeric'],
                'alto' => ['required', 'numeric'],
                'bajo' => ['required', 'numeric'],
                'cerrado' => ['required', 'numeric'],
            ]);
            if ($validate) {
                $hora = str_split($row['hora'], 2);
                $fechatmp1 = str_split($row['fecha'], 4);
                $fechatmp2 = str_split($fechatmp1[0], 2);
                $fecha = $fechatmp2[1].'/'.$fechatmp2[0].'/'.$fechatmp1[1];
                $data = [
                    'fecha' => $fecha,
                    'hora' => $hora[0].':'.$hora[1],
                    'abierto' => $row['abierto'],
                    'alto' => $row['alto'],
                    'bajo' => $row['bajo'],
                    'cerrado' => $row['cerrado'],
                ];
                
                $this->saveBotBrainbow($data);
            }
        }else{
            $validate = Validator::make($row, [
                'abierto' => ['required', 'numeric'],
                'alto' => ['required', 'numeric'],
                'bajo' => ['required', 'numeric'],
                'cerrado' => ['required', 'numeric'],
            ]);
            if ($validate) {
                $data = [
                    'abierto' => $row['abierto'],
                    'alto' => $row['alto'],
                    'bajo' => $row['bajo'],
                    'cerrado' => $row['cerrado'],
                ];
                $this->saveUpdateBot($data, $row['id']);
            }
        }
    }

    /**
     * Permite agregar nuevos registros
     *
     * @param array $data
     * @return void
     */
    public function saveBotBrainbow($data)
    {
        $botBrainbow = new BotBrainbowController();
        // dump($data['fecha'], $data['hora']);
        $data['fecha'] = $data['fecha'].' '.$data['hora'];
        // dd($data['fecha']);
        $fechaNumerica = new Carbon($data['fecha']);
        $data['fecha_numerica'] = $fechaNumerica->timestamp;
        $data['post_nega'] = $botBrainbow->getSubioBajo($data['fecha_numerica'], $data['cerrado']);
        $botBrainbow->updateBotBrainbow($data, true, 0);
    }

    /**
     * Permite actualizar el botBrainbow
     *
     * @param array $data
     * @param integer $idbot
     * @return void
     */
    public function saveUpdateBot($data, $idbot)
    {
        $botBrainbowController = new BotBrainbowController();
        $botbrainbow = Botbrainbow::find($idbot);
        $data['post_nega'] = $botBrainbowController->getSubioBajo($botbrainbow->fecha_numerica, $data['cerrado']);
        $botBrainbowController->updateBotBrainbow($data, false, $idbot);
    }
}
