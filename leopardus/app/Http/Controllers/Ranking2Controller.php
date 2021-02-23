<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use App\Settings; use App\User; use App\Rol; use App\Notification;
use Auth; use DB; use Carbon\Carbon; use App\SettingsEstructura;
use App\Commission;
use App\Http\Controllers\RankingController;


class Ranking2Controller extends Controller
{
   	function ranking()
	{
        // TITLE
		view()->share('title', 'Ranking');
		
		 $informacion = new RankingController;
		 
		 $rankingComisiones = $informacion->rankingComisiones();
		 
		  return view('admin.ranking')->with(compact('rankingComisiones'));
	}

}
