<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function test_users_index()
    {
        //inicio de sesion a la api
        $response = $this->json('POST','api/auth/users/login', [
            'email' => 'macasoft@example.com',
            'password' =>'password',
        ])->assertStatus(200)
        ->assertJson(["token_type"=>"Bearer"]);
        $data = $response->getData();

 // probar que la ruta funciona
         $this->get('api/auth/users',[
            'Content-Type'=>'application/json',
            'Authorization' =>'Bearer '.$data->access_token
        ])->assertStatus(200);

    }
    public function test_users_store()
    {
        // inicio de sesion a la api
        $response = $this->json('POST','api/auth/users/login', [
            'email' => 'macasoft@example.com',
            'password' =>'password',
        ])->assertStatus(200)
        ->assertJson(["token_type"=>"Bearer"]);
        $data = $response->getData();

//  probar que la ruta funciona
        $response = $this->withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' =>'Bearer '.$data->access_token,
        ])->json('POST', 'api/auth/users', 
        [
        'identificacion' => '1238910',
        'email'=>'prueba@gmail.coms',
        'nombre1'=>'nombre prueba',
        'apellido1'=>'apellido',
        'rol'=>'Usuario'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'resp' => true,
            ]);
    }

    public function test_users_show()
    {
        //inicio de sesion a la api
        $response = $this->json('POST','api/auth/users/login', [
            'email' => 'macasoft@example.com',
            'password' =>'password',
        ])->assertStatus(200)
        ->assertJson(["token_type"=>"Bearer"]);
        $data = $response->getData();

        // probar que la ruta funciona
        $response = $this->withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' =>'Bearer '.$data->access_token,
        ])->json('GET', 'api/auth/users/1');
        $response
            ->assertStatus(200);
            
    }
    public function test_users_update()
    {
        //inicio de sesion a la api
        $response = $this->json('POST','api/auth/users/login', [
            'email' => 'macasoft@example.com',
            'password' =>'password',
        ])->assertStatus(200)
        ->assertJson(["token_type"=>"Bearer"]);
        $data = $response->getData();

     // probar que la ruta funciona
        $response = $this->withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' =>'Bearer '.$data->access_token,
            ])->json('PUT', 'api/auth/users/2', 
            [
            'nombre1'=>'David macasoft',
            'apellido1'=>'RES',
            ]);
            $response
                ->assertStatus(200)
                ->assertJson([
                    'resp' => true,
                ]);
    }
    public function test_users_destroy()
    {
        //inicio de sesion a la api
        $response = $this->json('POST','api/auth/users/login', [
            'email' => 'macasoft@example.com',
            'password' =>'password',
        ])->assertStatus(200);
        $data = $response->getData();

     // probar que la ruta funciona
        $response = $this->withHeaders([
            'Content-Type'=>'application/json',
            'Authorization' =>'Bearer '.$data->access_token,
            ])->json('DELETE', 'api/auth/users/2');
        $response
            ->assertStatus(200);
    }
}
