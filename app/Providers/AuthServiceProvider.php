<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Auth::viaRequest('user-type',function ($request) {
        //     $user = User::where('email',$request->email)->first();
        //     if (!$user) {
        //         return null;
        //     };
        //     switch ($user->user_type) {
        //         case 1:
        //             if (Hash::check($request->password, $user->password)) {
        //                 return $user;
        //             };
        //             break;
        //         case 5:
        //             if (Hash::check($request->password, $user->password)) {
        //                 return $user;
        //             };
        //             break;
        //         case 10:
        //             if (Hash::check($request->password, $user->password)) {
        //                 return $user;
        //             };
        //             break;
        //         default:
        //             return null;
        //             break;
        //     };
        //     return null;
        // });
    }
}
