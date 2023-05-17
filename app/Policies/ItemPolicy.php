<?php

namespace App\Policies;

use App\Item;
use App\Shopowner;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Shopowner can view any models.
     *
     * @param  \App\Shopowner  $shoponwer
     * @return mixed
     */
    public function viewAny(Shopowner $shopowner, Item $item)
    {
        //
        return $shopowner->id === $item->shopowner_id
                                            ? Response::allow()
                                            : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the Shopowner can view the model.
     *
     * @param  \App\Shopowner  $shoponwer
     * @param  \App\Item  $item
     * @return mixed
     */
    public function view(Shopowner $shoponwer, Item $item)
    {
        //
    }

    /**
     * Determine whether the Shopowner can create models.
     *
     * @param  \App\Shopowner  $shopowner
     * @return mixed
     */
    public function create(Shopowner $shoponwer)
    {
        //
    }

    /**
     * Determine whether the Shopowner can update the model.
     *
     * @param  \App\Shopowner  $shopowner
     * @param  \App\Item  $item
     * @return mixed
     */
    public function update(Shopowner $shoponwer, Item $item)
    {
        //
    }

    /**
     * Determine whether the Shopowner can delete the model.
     *
     * @param  \App\Shopowner  $shopowner
     * @param  \App\Item  $item
     * @return mixed
     */
    public function delete(Shopowner $shopowner, Item $item)
    {
        //
    }

    /**
     * Determine whether the Shopowner can restore the model.
     *
     * @param  \App\Shopowner  $shopowner
     * @param  \App\Item  $item
     * @return mixed
     */
    public function restore(Shopowner $shopowner, Item $item)
    {
        //
    }

    /**
     * Determine whether the Shopowner can permanently delete the model.
     *
     * @param  \App\Shopowner  $shopowner
     * @param  \App\Item  $item
     * @return mixed
     */
    public function forceDelete(Shopowner $shopowner, Item $item)
    {
        //
    }
}
