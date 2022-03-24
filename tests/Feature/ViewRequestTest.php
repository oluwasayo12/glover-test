<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewRequestTest extends TestCase
{
    /**
     * Test to confirm view Access
     *
     * @return void
     */
    public function test_view_request_access_available()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "super_admin@glover.com",
            'password' => "gloversuperadmin"
        ]);

        $view_request_response = $this->get("api/v1/view-pending-requests",["Authorization" => "Bearer ".$login['data']['access_token']]);
        $view_request_response->assertStatus(200);
        $view_request_response->assertJsonFragment([
            'message' => 'All requests'
        ]);
    }
}
