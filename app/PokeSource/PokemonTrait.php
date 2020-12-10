<?php

namespace App\PokeSource;

trait PokemonTrait
{
    private static $instance = null;

    public static function spawn($name)
    {
        try {
            
            self::$instance = new Pokemon($name);
            return self::$instance;

        } catch (\Exception $ex) {

            // Just return null no pokemon found
            if($ex->getCode()==404)
                return null;

            // Throw other errors
            throw $ex;
        }
    }
}
