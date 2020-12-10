<?php

namespace App\PokeSource;
use Poke;

class Pokemon
{
    use PokemonTrait;
    
    private $raw_pokemon = null;
    private $poke_form = null;

    public $name = null;
    public $image = null;

    public function __construct($name)
    {
        $this->raw_pokemon = Poke::go()->pokemon($name);
        $this->poke_form = Poke::go()->pokemonForm($this->raw_pokemon->id);

        $this->populate_information();
    }
    
    private function populate_information()
    {
        $this->name = $this->raw_pokemon->name;
        $this->image = $this->poke_form->sprites->front_default;
    }

}
