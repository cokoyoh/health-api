<?php

use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(User::class, 5)->create();
        factory(User::class, 2)->create()->each(function ($user) {
            $roleId = Role::where('name', 'admin')->first()->id;
            $user->roles()->attach($roleId,['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        });
        factory(User::class, 3)->create()->each(function ($user) {
            $roleId = Role::where('name', 'client')->first()->id;
            $user->roles()->attach($roleId,['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);
        });
    }
}
