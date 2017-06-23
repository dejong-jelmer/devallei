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
                'id' => 1,
                'coach' => 'Tim',
                'voornaam'=> 'Tim',
                'tussenvoegsel' => 'de',
                'achternaam' => 'Boer',
                'email' => 'timdeboer@live.nl',
                'telefoon' => '024-1234567',
                'mobiel' => '06-12345678',
                'straat' => 'Daliastraat',
                'huisnummer' => '28',
                'postcode' => '6524DF',
            ])
            ->seeJson([
                'id' => 2,
                'coach' => 'Judith',
                'voornaam'=> 'Judith',
                'tussenvoegsel' => '',
                'achternaam' => 'Fransen',
                'email' => 'j.fransen@gmail.com',
                'telefoon' => '024-7654321',
                'mobiel' => '06-87654321',
                'straat' => 'Dreef',
                'huisnummer' => '313',
                'postcode' => '6523MS',
            ]);
    }

    /**
    * @test
    **/
    public function show_should_return_a_valid_coach()
    {
        $this
            ->get('/coaches/1')
            ->seeStatusCode(200)
            ->seeJson([
                'id' => 1,
                'coach' => 'Tim',
                'voornaam' => 'Tim',
                'tussenvoegsel' => 'de',
                'achternaam' => 'Boer',
                'email' => 'timdeboer@live.nl',
                'telefoon' => '024-1234567',
                'mobiel' => '06-12345678',
                'straat' => 'Daliastraat',
                'huisnummer' => '28',
                'postcode' => '6524DF',
            ]);

        $data = json_decode($this->response->getContent(), true);

        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }
    
    /**
    * @test
    **/
    public function show_should_fail_when_coach_id_does_not_exist()
    {
            $this
                ->get('/coaches/99999')
                ->seeStatusCode(404)
                ->seeJson([
                    'error' => [
                        'message' => 'coach niet gevonden'
                    ]
                ]);
    }

    /**
    * @test
    **/
    public function show_route_should_not_match_an_invalid_route()
    {
        $this->get('/coaches/this-is-invalid');

        $this->assertNotRegExp(
            '/coach niet gevonden/',
            $this->response->getContent(),
            'CoachController@show route matching when it should not.'
        );
    }

    /**
     * @test
     */
    public function store_should_save_new_choach_in_database()
    {
        $this->post('/coaches', [
                'coach' => 'Henk',
                'voornaam' => 'Henk',
                'tussenvoegsel' => '',
                'achternaam' => 'Prinsen',
                'email' => '',
                'telefoon' => '',
                'mobiel' => '',
                'straat' => '',
                'huisnummer' => '',
                'postcode' => '',
            ]);

        $this
            ->seeJson(['created' => true])
            ->seeInDatabase('coaches', ['coach' => 'Henk']);
    }
    
    /**
     * @test
     */
    public function store_should_respond_with_a_201_and_location_header_when_successful()
    {
        $this->post('/coaches', [
             'coach' => 'Henk',
             'voornaam' => 'Henk',
             'tussenvoegsel' => '',
             'achternaam' => 'Prinsen',
             'email' => '',
             'telefoon' => '',
             'mobiel' => '',
             'straat' => '',
             'huisnummer' => '',
             'postcode' => '',
            ]);

        $this
            ->seeStatusCode(201)
            ->seeHeaderWithRegExp('Location', '#/coaches/[\d]+$#');
    }

    /** @test **/
    public function update_should_only_change_fillable_fields()
    {
        $this->notSeeInDatabase('coaches', [
                'coach' => 'Marco',
            ]);

        $this->put('/coaches/1', [
                'id' => 5,
                'coach' => 'Tim',
                'voornaam' => 'Tim',
                'tussenvoegsel' => 'de',
                'achternaam' => 'Boer',
                'email' => 'timdeboer@live.nl',
            ]);

        $this
            ->seeStatusCode(200)
            ->seeJson([
                'id' => 1,
                'coach' => 'Tim',
                'voornaam' => 'Tim',
                'tussenvoegsel' => 'de',
                'achternaam' => 'Boer',
                'email' => 'timdeboer@live.nl',
            ])
        ->seeInDatabase('coaches', [
                'coach' => 'Tim',
            ]);
    }

    /**
     * @test
     */
    public function update_should_fail_with_an_invalid_id()
    {
        $this
            ->put('/coaches/9999999999999999')
            ->seeStatusCode(404)
            ->seeJsonEquals([
                    'error' => [

                        'message' => 'coach niet gevonden'
                    ]
                ]);
    }

    /**
     * @test
     */
    public function update_should_not_match_an_invalid_route()
    {
        $this->put('coaches/this-is-invalid')
        ->seeStatusCode(404);
    }

}
