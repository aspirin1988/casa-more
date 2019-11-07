<?php namespace Aspirin1988\Ruslug;

use Illuminate\Support\Facades\Facade;

class RuslugFacade extends Facade{

    protected static function getFacadeAccessor(){
        return 'slug';
    }
}