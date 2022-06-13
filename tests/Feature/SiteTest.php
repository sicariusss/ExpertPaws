<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSiteRoutes()
    {
        // Проверка сайта

        $mainPage = $this->get('/');
        $mainPage->assertStatus(200);

        $aboutPage = $this->get('/about');
        $aboutPage->assertStatus(200);

        $coursesPage = $this->get('/courses');
        $coursesPage->assertStatus(200);

        $reviewsPage = $this->get('/reviews');
        $reviewsPage->assertStatus(200);

        $contactsPage = $this->get('/contacts');
        $contactsPage->assertStatus(200);

        $loginPage = $this->get('/login');
        $loginPage->assertStatus(200);

        $registerPage = $this->get('/register');
        $registerPage->assertStatus(200);
    }
}
