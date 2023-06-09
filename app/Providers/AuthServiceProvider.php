<?php

namespace App\Providers;

use App\Featuresforshops;
use App\Http\Controllers\traid\UserRole;
use App\Policies\ItemYkPolicy;

use App\Item;
use App\Role;
use App\sitesettings;
use App\User;
use App\Manager;
use App\Shopowner;
use App\ShweNews\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use UserRole;
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // Item::class => ItemPolicy::class,
        // Shopowner::class => ShopownerPolicy::class,
        // 'App\Manager' => 'App\Policies\ManagerPolicy'

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('can_use_pos', function () {
            $checkpos=Featuresforshops::where([['shop_id','=',$this->getshopid()],['feature','=','pos']])->first();
            $sitesetting = sitesettings::where('name', 'pos')->first();
            if ($sitesetting->action == 'on' && !empty($checkpos)) {
                return true;
            }else{
                return false;
            }





        });
        // Gate::define('role-users', function ($user,$manager) {
        //     return $user->id === $manager->shop_id;
        // });

        // Gate::define('users', function (Manager $user) {
        //     return $user->role_id === 2;
        // });

    }
}
