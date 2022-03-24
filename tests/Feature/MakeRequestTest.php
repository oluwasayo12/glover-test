<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MakeRequestTest extends TestCase
{
    /**
     * test to confirm if user has permission to make request
     *
     * @return void
     */
    public function test_make_request_access_unavailable()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "super_admin@glover.com",
            'password' => "gloversuperadmin"
        ]);

        $make_request_response = $this->post("api/v1/make_request",[
            "customer_id"=> 1,
            "customer_data_action"=>"delete"
        ],["Authorization" => "Bearer ".$login['data']['access_token']]);

        $make_request_response->assertStatus(403);
        $make_request_response->assertJsonFragment([
            'message' => 'User does not have the right roles.'
        ]);
    }

    /**
     * test user has make request permission
     *
     * @return void
     */
    public function test_make_request_access_available()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "create_request@glover.com",
            'password' => "glovercreateadmin"
        ]);

        $make_request_response = $this->post("api/v1/make_request",[
            "customer_id"=> 1,
            "customer_data_action"=>"delete"
        ],["Authorization" => "Bearer ".$login['data']['access_token']]);

        $make_request_response->assertStatus(200);
        $make_request_response->assertJsonFragment([
            'message' => 'Request Initialized. Awaiting Approval'
        ]);
    }
}
