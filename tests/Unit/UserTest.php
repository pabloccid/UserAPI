<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserTest extends TestCase
{

     public function setUp()
    {
		parent::setUp();
		$this->artisan('migrate:refresh');
		$this->seed();
    }

    public function testGetSuccessfully()
    {
        $this->json('GET', 'users/15')
            ->assertStatus(200)
            ->assertJson([
                'id' => '15',
                'image' => '',
            ]);
    }

    public function testGetFailure()
    {
        $this->json('GET', 'users/16')
            ->assertStatus(404)
            ->assertJson([
                'error' => 'Couldn\'t find the specified user',
                'code' => '404',
            ]);
    }

    public function testUpdateSuccessfully()
    {
        $payload = [
        	'id' => '15',
            'email' => 'unit@test.com',
            'name' => 'This is a Test'
        ];

        $this->json('PUT', 'users/15', $payload)
            ->assertStatus(200)
            ->assertJson($payload);
    }

    public function testUpdateFailure()
    {
        $payload = [
        	'id' => '16',
            'email' => 'unit@test.com',
            'name' => 'This is a Test'
        ];

        $this->json('PUT', 'users/16', $payload)
            ->assertStatus(404)
            ->assertJson([
                'error' => 'Couldn\'t find the specified user',
                'code' => '404',
            ]);
    }

    public function testDeleteSuccessfully()
    {
        $this->json('DELETE', 'users/1')
            ->assertStatus(204);
    }

    public function testDeleteFailure()
    {
        $this->json('DELETE', 'users/16')
            ->assertStatus(404)
            ->assertJson([
                'error' => 'Couldn\'t find the specified user',
                'code' => '404',
            ]);
    }

/*
    public function testPostImageSuccessfully()
    {
        Storage::fake('images');

        $response = $this->json('POST', '/users/2/image', [
            'image' => UploadedFile::fake()->image('unittest.png')
        ]);


        Storage::disk('images')->assertExists('2.png');       

        $response = $this->json('POST', '/users/2/image', [
            'image' => UploadedFile::fake()->image('unittest.jpg')
        ]);        

        Storage::disk('images')->assertExists('2.jpg');

        Storage::disk('images')->assertMissing('2.png');
    }
*/
    public function testPostImageFailureNoImage()
    {
    	$this->json('POST', '/users/2/image')
    	->assertStatus(404)
        ->assertJson([
            'error' => 'No image found on request',
            'code' => '404',
        ]);
    }


    public function testPostImageFailureNotFound()
    {
    	$this->json('POST', '/users/16/image', [
            'image' => UploadedFile::fake()->image('unittest.png')
        ])->assertStatus(404)
        ->assertJson([
            'error' => 'Couldn\'t find the specified user',
            'code' => '404',
        ]);
    }       

}
