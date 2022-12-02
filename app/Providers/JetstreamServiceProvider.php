<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {
        Fortify::authenticateUsing(function(Request $request){
            $user = User::where('email', $request->email)->first();
            if($user && Hash::check($request->password, $user->password)){
                return $user;
            }
            else if($user && !Hash::check($request->password, $user->password)){
                throw ValidationException::withMessages(['Please Enter a correct Password']);
                return false;
            }
            else{
                throw ValidationException::withMessages(['The email is not yet registered']);
                return false;
            }
        });
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
     
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
