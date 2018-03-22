<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Tests;

class SearchControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testBasicProvinces()
    {

        $response = $this->get('/search/provinces/5');

        // $response = $this->json('POST', '/search/provinces/5', ['id' => '5']);
        $data = $response->baseResponse->original;
        Tests::updateOrCreate(
                    ['keys'       => 'provinces'],[
                    'keys'     => 'provinces',
                    'string'        => $data,
                ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(["data"])
            ->assertSuccessful();
    }

    public function testBasicCities()
    {

        $response = $this->get('/search/cities/5');

        // $response = $this->json('POST', '/search/cities/5', ['id' => '5']);
        $data = $response->baseResponse->original;
        Tests::updateOrCreate(
                    ['keys'       => 'cities'],[
                    'keys'     => 'cities',
                    'string'        => $data,
                ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(["data"])
            ->assertSuccessful();
    }
}
