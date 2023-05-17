<?php
namespace App\Facade;

use App\Gate;
use Illuminate\Support\Facades\Facade;

class TzGate extends Facade{
    
    protected static function getFacadeAccessor()
    {
        return Gate::class;
    }
}