<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
   /**
    * test admin login
    *
    * @return void
    */
    public function test_admin_authentication()
    {

        $response = $this->post("api/auth/login", [
            'email' => "super_admin@glover.com",
            'password' => "gloversuperadmin"
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'login successful'
        ]);
    }

    public function test_admin_logout()
    {
        $login =  $this->post("api/auth/login", [
            'email' => "super_admin@glover.com",
            'password' => "gloversuperadmin"
        ]);

        $logout = $this->post("api/v1/logout",[],["Authorization" => "Bearer ".$login['data']['access_token']]);

        $logout->assertStatus(200);
        $logout->assertJsonFragment([
            'message' => 'logout successful'
        ]);
    }

}
