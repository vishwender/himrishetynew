<?php

namespace Tests\Feature;

use Tests\TestCase;

class ForgotPasswordViewTest extends TestCase
{
    public function test_password_reset_request_page_is_available()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.email');
    }
}
