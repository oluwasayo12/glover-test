<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProcessRequestTest extends TestCase
{

    public function test_process_request_access_unavailable()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "super_admin@glover.com",
            'password' => "gloversuperadmin"
        ]);

        $make_request_response = $this->post("api/v1/approve_request",[
            "request_id"=> 5,
            "request_action"=>"approve"
        ],["Authorization" => "Bearer ".$login['data']['access_token']]);

        $make_request_response->assertStatus(403);
        $make_request_response->assertJsonFragment([
            'message' => 'User does not have the right roles.'
        ]);
    }

    public function test_process_request_access_available()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "update_request_status_admin@glover.com",
            'password' => "gloverupdaterequestadmin"
        ]);

        $make_request_response = $this->post("api/v1/approve_request",[
            "request_id"=> 1,
            "request_action"=>"approve"
        ],["Authorization" => "Bearer ".$login['data']['access_token']]);

        
        $make_request_response->assertStatus(400);
        $make_request_response->assertJsonFragment([
            'message' => 'Unable to process request'
        ]);
    }

}
