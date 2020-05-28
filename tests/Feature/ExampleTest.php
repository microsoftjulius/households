<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /** 
     * function to create account 
     * @test
     * */
    public function createAccount(){
        $this->withoutExceptionHandling();
        $response = $this->post('api/create-account',[
            'name'       => 'Julius Ssemakula',
            'email'      => 'julisema4@gmail.com',
            'password'   => '123Jane14.',
            'c_password' => '123Jane14.',
            'status'     => 'active'
        ]);
        $this->assertDatabaseHas('users',['email' => 'julisema4@gmail.com']);
    }

    /** 
     * function to delete account 
     * @test
     * */
    public function deleteMyAccount(){
        $this->createAccount();
        $user_id = User::first();
        $response = $this->delete('api/delete-account/'.$user_id->id);
        $this->assertDatabaseHas('users',['status' => 'deleted']);
    }

    /**
     * function to get all the users
     * @test
     */

    public function getAllUsers(){
        $this->createAccount();
        $response = $this->get('api/get-all-users');
        $response->assertOk();
    }
}
