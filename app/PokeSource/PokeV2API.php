<?php

namespace App\PokeSource;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Pagination\LengthAwarePaginator;

class PokeV2API
{
    private static $instance = null;

    private $client = null;
    private $base_uri = "https://pokeapi.co/api/v2/";

    public static function go()
    {
        if( !self::$instance ) 
        {
            self::$instance = new PokeV2API();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->client = new GuzzleClient(['base_uri' => $this->base_uri]);
    }

 
    /**
     * List Pokemon
     */
    public function pokemons($page=1,$limit=15)
    {

        // Calculate the offset base on the page
        $offset = ($page - 1) * $limit;

        $response = $this->client->request('GET', "pokemon?limit={$limit}&offset={$offset}");
        $result = json_decode($response->getBody());

        $pokemons = new LengthAwarePaginator($result->results,$result->count,$limit,$page);


        return $pokemons;
    }

    /**
     * Search pokemon by name and return as list
     * @param $name Name of the pokemon
     */
    public function search($name)
    {
        try {

            // simulate result from pokemon list
            $pokemons = new LengthAwarePaginator([$this->pokemon($name)],1,1,1);
            return $pokemons;

        } catch (\Exception $er) {

            if(!$er->getCode()==404)
                throw $er;

        } 
    }
    
    /**
     * Get pokemon info
     * @param $name Name of the pokemon
     */
    public function pokemon($name)
    {
        $response = $this->client->request('GET', "pokemon/{$name}");
 
        if($response == null)
            throw new \Exception("Unknown pokemon {$name}",404); 

        $pokemon = json_decode($response->getBody());

        return $pokemon;
    }
    
    public function pokemonForm($id)
    {
        $response = $this->client->request('GET', "pokemon-form/{$id}");
 
        if($response == null)
            throw new \Exception("Unknown pokemon with id {$id}",404); 

        $form = json_decode($response->getBody());
        return $form;
    }
}
