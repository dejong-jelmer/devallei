<?php

namespace Tests\App\Http\Controllers;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class CoachesControllerTest extends TestCase
{
    
    use DatabaseMigrations;

    /** 
     * @test 
     */
    public function index_status_code_should_be_200()
    {
        $this->get('api/v1/coaches')->seeStatusCode(200);
    }


    /**
     * @test
     */
    public function index_should_return_a_collection_of_records()
    {
        $coaches = factory('App\Models\Coach', 2)->create();

        $this->get('/api/v1/coaches');

        foreach ($coaches as $coach) {
            $this->seeJson(['coach' => $coach->coach]);
        }

        
    }

    /**
    * @test
    **/
    public function view_should_return_a_valid_coach()
    {
        
        $coach = factory('App\Models\Coach')->create();
        // dd($coach->id);
        $this
            ->get("/api/v1/coaches/{$coach->id}")
            ->seeStatusCode(200)
            ->seeJson([
                'id' => $coach->id,
                'coach' => $coach->coach,
                'voornaam' => $coach->voornaam,
                // 'tussenvoegsel' => $coach->tussenvoegsel,
                // 'achternaam' => $coach->achternaam,
                // 'email' => $coach->email,
              //   'telefoon' => '024-1234567',
              //   'mobiel' => '06-12345678',
              //   'straat' => 'Daliastraat',
              //   'huisnummer' => '28',
              //   'postcode' => '6524DF',
            ]);

        $data = json_decode($this->response->getContent(), true);

        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }
    
    /**
    * @test
    **/
    public function view_should_fail_when_coach_id_does_not_exist()
    {
            $this
                ->get('api/v1/coaches/9999999')
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
    public function view_route_should_not_match_an_invalid_route()
    {
        $this->get('/api/v1/coaches/this-is-invalid');

        $this->assertNotRegExp(
            '/coach niet gevonden/',
            $this->response->getContent(),
            'CoachController@show route matching when it should not.'
        );
    }

    /**
     * @test
     */
    public function create_should_save_new_choach_in_database()
    {
        $this->post('/api/v1/coaches', [
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
    public function create_should_respond_with_a_201_and_location_header_when_successful()
    {
        $this->post('/api/v1/coaches', [
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
        $coach = factory('App\Models\Coach')->create();
        
        
        $this->put("/api/v1/coaches/{$coach->id}", [
                'id' => $coach->id,
                'coach' => $coach->coach,
                'voornaam' => $coach->voornaam,
                'tussenvoegsel' => $coach->tussenvoegsel,
                'achternaam' => $coach->achternaam,
                'email' => $coach->email,
            ]);

        $this
            ->seeStatusCode(200)
            ->seeJson([
                'id' => $coach->id,
                'coach' => $coach->coach,
                'voornaam' => $coach->voornaam,
                'tussenvoegsel' => $coach->tussenvoegsel,
                'achternaam' => $coach->achternaam,
                'email' => $coach->email,
            ])
        ->seeInDatabase('coaches', [
                'coach' => $coach->coach,
            ]);

    }

    /**
     * @test
     */
    public function update_should_fail_with_an_invalid_id()
    {
        $this
            ->put('/api/v1/coaches/9999999999999999')
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
        $this->put('/api/v1/coaches/this-is-invalid')
        ->seeStatusCode(404);
    }

    /**
     * @test
     */
    public function delete_should_remove_a_valid_coach()
    {
        $coach = factory('App\Models\Coach')->create();
        $this
            ->delete("/api/v1/coaches/{$coach->id}")
            ->seeStatusCode(204)
            ->isEmpty();

        $this->notSeeInDatabase('coaches', ['id' => $coach->id]);
    }

    /**
     * @test
     */
    public function destroy_should_return_a_404_with_an_invalid_id()
    {
        $this
            ->delete('/api/v1/coaches/999999999')
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
    public function destroy_should_not_match_an_invalid_route()
    {
            $this
                ->delete('/api/v1/coaches/this-is-invalid')
                ->seeStatusCode(404);
    }

}
