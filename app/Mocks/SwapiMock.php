<?php

namespace App\Mocks;

use File;

class SwapiMock
{
	/**
	 * Get the mock data for films
	 * 
	 * @return array
	 */
	public static function films()
	{
		$json = File::get(resource_path('mock-data/films.json'));

		return json_decode($json, true);
	}

	/**
	 * Get the mock data for planets
	 * 
	 * @return array
	 */
	public static function planets()
	{
		$json = File::get(resource_path('mock-data/planets.json'));

		return json_decode($json, true);
	}

}