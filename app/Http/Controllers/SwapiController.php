<?php

namespace App\Http\Controllers;


use App\Models\Film;
use App\Models\Planet;
use App\Models\People;
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
        $this->getFilms();   
        $this->getPlanets();   
        $this->getPeople();
    }

    /**
     * Fetch all films from swapi.dev, save them to the database and also cache it
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
     * Fetch all planets from swapi.dev, save them to the database and also cache it 
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

            foreach ($planets['results'] as $planet) {  
                $created = explode('.', $planet['created']);
                $created = $created[0];

                $edited = explode('.', $planet['edited']);
                $edited = $edited[0];

                $data['name'] = $planet['name']; 
                $data['diameter'] = $planet['diameter'];
                $data['rotation_period'] = $planet['rotation_period'];
                $data['orbital_period'] = $planet['orbital_period'];
                $data['gravity'] = $planet['gravity'];
                $data['population'] = $planet['population'];
                $data['climate'] = $planet['climate'];
                $data['terrain'] = $planet['terrain'];
                $data['surface_water'] = $planet['surface_water'];
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

    /**
     * Fetch all planets from swapi.dev, save them to the database and also cache it 
     * 
     * @return void
     */
    public function getPeople()
    {
        if (People::count() < 1) {
            $url = $this->baseUrl . 'people';

            $people = (config('app.env') === 'mock') ? SwapiMock::people() : Http::get($url);

            $newPeople = [];
            $data = [];

            foreach ($people['results'] as $person) {  
                $created = explode('.', $person['created']);
                $created = $created[0];

                $edited = explode('.', $person['edited']);
                $edited = $edited[0];

                $planet = explode('/', $person['homeworld']);
                $planetId = $planet[(int) count($planet) - 2];

                $exists = Planet::find($planetId);

                if ($exists) {
                    $data['name'] = $person['name']; 
                    $data['birth_year'] = $person['birth_year'];
                    $data['eye_color'] = $person['eye_color'];
                    $data['gender'] = $person['gender'];
                    $data['hair_color'] = $person['hair_color'];
                    $data['height'] = $person['height'];
                    $data['mass'] = $person['mass'];
                    $data['skin_color'] = $person['skin_color'];
                    $data['planet_id'] = $planetId;
                    $data['created'] = $created;
                    $data['edited'] = $edited;
                    $data['created_at'] = now();
                    $data['updated_at'] = now();
                    
                    array_push($newPeople, $data);
                } 
            }
            
            People::insert($newPeople);
        }

        Cache::remember('cachedPeople', 1800, function () {
            return People::all();
        });
    }

}
