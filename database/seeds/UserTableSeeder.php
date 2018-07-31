<?php

use Illuminate\Database\Seeder;
use CodeDelivery\Models\User;
use CodeDelivery\Models\Client;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Kásio User',
            'email' => 'user@user.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),

        ])->client()->save(factory(Client::class)->make());

        factory(User::class)->create([
            'name' => 'Kásio Admin',
            'email' => 'admin@user.com',
            'role' => 'admin',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),

        ])->client()->save(factory(Client::class)->make());

        factory(User::class, 10)->create()->each(function($u){
        	$u->client()->save(factory(Client::class)->make());
        });

        factory(User::class,3)->create([
            'role' => 'deliveryman',

        ]);

    }
}
