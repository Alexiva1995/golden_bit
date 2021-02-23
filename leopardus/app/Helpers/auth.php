<?php
if (!function_exists('checkAndShareAuth')) {
	//
	function checkAndShareAuth()
	{
		$isAuth = Auth::check();

		return dd( $isAuth );

		if( $isAuth ) {
		    //
		    $member = Auth::user();
		    //
		    view()->share( compact('member') );
		}

		view()->share( compact('isAuth') );
	}
}