<?php

namespace App\Http\Controllers;


use App\Models\Film;
use App\Models\Planet;
use App\Mocks\SwapiMock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SwapiController extends Controller
{
    private $baseUrl = 'https://swapi.dev/api/';

    /** 
     * Get all the needed data from SWAPI 
     * 
     * @return void
     */
    public function index()
    {
        // $this->getFilms();   
        $this->getPlanets();   
    }

    /**
     * Fetch all films from swapi.dev save them to the database and also cache it
     * 
     * @return void
     */
    public function getFilms()
    {
        if (Film::count() < 1) {
            $url = $this->baseUrl . 'films';

            $films = (config('app.env') === 'mock') ? SwapiMock::films() : Http::get($url);

            $newFilms = [];
            $data = [];

            foreach ($films['results'] as $film) {  
                $created = explode('.', $film['created']);
                $created = $created[0];

                $edited = explode('.', $film['edited']);
                $edited = $edited[0];

                $data['title'] = $film['title']; 
                $data['episode_id'] = $film['episode_id'];
                $data['opening_crawl'] = $film['opening_crawl'];
                $data['director'] = $film['director'];
                $data['producer'] = $film['producer'];
                $data['release_date'] = $film['release_date'];
                $data['created'] = $created;
                $data['edited'] = $edited;
                $data['created_at'] = now();
                $data['updated_at'] = now();
                
                array_push($newFilms, $data);
            }

            Film::insert($newFilms);
        }

        Cache::remember('cachedFilms', 1800, function () {
            return Film::all();
        });
    }

    /**
     * Fetch all planets from swapi.dev 
     * 
     * @return void
     */
    public function getPlanets()
    {
        if (Planet::count() < 1) {
            $url = $this->baseUrl . 'planets';

            $planets = (config('app.env') === 'mock') ? SwapiMock::planets() : Http::get($url);

            $newPlanets = [];
            $data = [];

            foreach ($planets['results'] as $film) {  
                $created = explode('.', $film['created']);
                $created = $created[0];

                $edited = explode('.', $film['edited']);
                $edited = $edited[0];

                $data['name'] = $film['name']; 
                $data['diameter'] = $film['diameter'];
                $data['rotation_period'] = $film['rotation_period'];
                $data['orbital_period'] = $film['orbital_period'];
                $data['gravity'] = $film['gravity'];
                $data['population'] = $film['population'];
                $data['climate'] = $film['climate'];
                $data['terrain'] = $film['terrain'];
                $data['surface_water'] = $film['surface_water'];
                $data['created'] = $created;
                $data['edited'] = $edited;
                $data['created_at'] = now();
                $data['updated_at'] = now();
                
                array_push($newPlanets, $data);
            }

            Planet::insert($newPlanets);
        }

        Cache::remember('cachedPlanets', 1800, function () {
            return Planet::all();
        });
    }

}
