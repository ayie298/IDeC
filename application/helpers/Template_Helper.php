<?php
function load_partials($file)
{
	if(file_exists(APPPATH . 'views/themes/partials/' . $file)) {
		require_once APPPATH . 'views/themes/partials/' . $file;
	}
}

function logged_in()
{
	$session = $_SESSION;

	if(!empty($session['identity'])) {
		return TRUE;
	}

	return FALSE;
}

function date_diffs($time1 = 0, $time2 = 0)
{
	$time1 = strtotime($time1);
	$time2 = strtotime($time2);

	$time  = round(($time2-$time1)/60);

	return $time;
}