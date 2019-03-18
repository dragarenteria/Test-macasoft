<?php

use Illuminate\Database\Seeder;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'nombre1' => 'David',
        'nombre2' => '',
        'apellido1' => 'Raga',
        'apellido2' => 'Renteria',
        'avatar' => null,
        'identificacion'=>'1234567',
        'email' => 'macasoft@example.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        ]);
        factory(App\User::class, 1)->create();
        $this->call(PermissionsTableSeeder::class);

        //para ejecutar el client de la api
        Artisan::call('passport:client --personal');

    }
}
