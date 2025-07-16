<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use App\Policies\BookingPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
   protected $policies = [
    \App\Models\User::class => \App\Policies\UserPolicy::class,
    \App\Models\Booking::class => \App\Policies\BookingPolicy::class, // ✅ Add this line
];



    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
