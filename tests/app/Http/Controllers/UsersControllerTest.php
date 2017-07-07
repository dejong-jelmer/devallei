<?php

namespace Tests\App\Http\Controllers;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class UsersControllerTest extends TestCase
{
    
    use DatabaseMigrations;

    /**
     * @test
     */
    public function create_should_save_new_user_in_database()
    {
        
        $user = factory('App\Models\User')->create();

        $this->post('api/v1/users', [
                'naam' => $user->naam,
            ]);

        $this
            ->seeJson(['created' => true])
            ->seeInDatabase('users', ['naam' => $user->naam]);
    }

}