<?php

namespace Tests\Feature;

use Mockery;
use App\User;
use Tests\TestCase;
use App\Search\FilterQuery;
use App\Search\SampleQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHome()
    {
        $user = factory(User::class)->create();

        SearchConsole::shouldReceive('setAccessToken->listSites')->andReturn([]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }

    public function testSite()
    {
        $user = factory(User::class)->create();

        SearchConsole::shouldReceive('setAccessToken->query')
                     ->with('test', Mockery::type(SampleQuery::class))
                     ->once()
                     ->andReturn([]);

        $response = $this->actingAs($user)->get('/site?url=test');

        $response->assertStatus(200);
    }

    public function testFilter()
    {
        $user = factory(User::class)->create();

        SearchConsole::shouldReceive('setAccessToken->query')
                     ->with('test', FilterQuery::class)
                     ->once()
                     ->andReturn([]);

        $response = $this->actingAs($user)->get('/filter?q=test&url=test');

        $response->assertStatus(200);
    }
}
