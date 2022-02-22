<?php

namespace App\Mocks;

use File;

class SwapiMock
{

	public static function films()
	{
		$json = File::get(resource_path('mock-data/films.json'));

		return json_decode($json, true);
	}

	
}