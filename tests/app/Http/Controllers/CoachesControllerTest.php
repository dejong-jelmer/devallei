<?php

namespace Tests\App\Http\Controllers;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CoachesControllerTest extends TestCase
{
    /** 
     * @test 
     */
    public function index_status_code_should_be_200()
    {
        $this->get('/coaches')->seeStatusCode(200);
    }


    /**
     * @test
     */
    public function index_should_return_collection_of_records()
    {
        $this
            ->get('/coaches')
            ->seeJson([
                'coach' => 'Judith',
            ])
            ->seeJson([
                'coach' => 'Tim',
            ]);
    }
}
