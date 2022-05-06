<?php

namespace Tests\Feature;

use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OfferControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Authorization()
    {
        $response = $this->get("/api/v1/presents/bad-id/name?token=bad-token");
        $response->assertStatus(403);
    }

    public function test_presentsName()
    {
        $token = config('app.api_token');

        $response = $this->get("/api/v1/presents/bad-id/name?token=$token");
        $response->assertStatus(404);

        $offer = Offer::first();
        $response = $this->get("/api/v1/presents/{$offer->code}/name?token=$token");
        $response->assertStatus(200)->assertSee($offer->name, false);
    }

    public function test_presentsDescription()
    {
        $token = config('app.api_token');

        $response = $this->get("/api/v1/presents/bad-id/description?token=$token");
        $response->assertStatus(404);

        $offer = Offer::first();
        $response = $this->get("/api/v1/presents/{$offer->code}/description?token=$token");
        $response->assertStatus(200)->assertSee($offer->description, false);
    }

    public function test_presents()
    {
        $token = config('app.api_token');

        $offer = Offer::first();
        $response = $this->get("/api/v1/presents/{$offer->merchant}?token=$token");
        $response->assertStatus(200)->assertSee($offer->code, false);
    }

    public function test_search()
    {
        $token = config('app.api_token');
        $offer = Offer::first();
        $data = [
            'token' => $token,
            'q' => $offer->name,
            'ln' => $offer->ln,
            'host' => $this->faker->domainName(),
            'geo' => $offer->geo,
            'c' => 1,
        ];

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['token' => 'bad-token']));
        $response->assertStatus(403);

        //==========ln===============
        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['ln' => null]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['ln' => 'bad']));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        foreach (['english', 'russian'] as $ln) {
            $response = $this->json('GET', '/api/v1/search', array_merge($data, ['ln' => $ln]));
            $response->assertStatus(200);
            $this->assertTrue($response['success']);
        }

        //==========geo===============
        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['geo' => null]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['geo' => 'bad']));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        foreach (['en', 'ru', 'ua'] as $ln) {
            $response = $this->json('GET', '/api/v1/search', array_merge($data, ['geo' => $ln]));
            $response->assertStatus(200);
            $this->assertTrue($response['success']);
        }

        //==========host===============
        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['host' => null]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        //==========count===============
        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['c' => null]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['c' => 0]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['c' => 101]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['c' => '1a1']));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        //==========query===============
        $response = $this->json('GET', '/api/v1/search', array_merge($data, ['q' => null]));
        $response->assertStatus(200)->assertJsonPath('message', 'Validation errors');

        $response = $this->json('GET', '/api/v1/search', $data);
        $response->assertStatus(200);
        $this->assertTrue($response['offers'][0]['code'] == $offer->code);
    }
}
