<?php

namespace App\Policies;

use App\Manager;
use App\Shopowner;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopownerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(Manager $manager, Shopowner $shopowner)
    {
        return $manager->id === $shopowner->manager_id;
    }
}
