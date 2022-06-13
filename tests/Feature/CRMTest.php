<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRMTest extends TestCase
{
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testCrmRoutesWithoutRights()
//    {
//        // Проверка CRM
//
//        $user = User::firstWhere('role_id', Role::USER);
//
//        $crmAsGuest = $this->get('/crm/');
//        $crmAsGuest->assertStatus(302);
//
//        $usersCrmAsUser = $this->actingAs($user)->get('/crm/users');
//        $usersCrmAsUser->assertStatus(302);
//
//        $rolesCrmAsGuest = $this->get('/crm/roles');
//        $rolesCrmAsGuest->assertStatus(302);
//
//        $coursesCrmAsUser = $this->actingAs($user)->get('/crm/courses');
//        $coursesCrmAsUser->assertStatus(302);
//
//        $chaptersCrmAsGuest = $this->get('/crm/chapters');
//        $chaptersCrmAsGuest->assertStatus(302);
//
//        $lessonsCrmAsUser = $this->actingAs($user)->get('/crm/lessons');
//        $lessonsCrmAsUser->assertStatus(302);
//
//        $contactsCrmAsGuest = $this->get('/crm/contacts');
//        $contactsCrmAsGuest->assertStatus(302);
//
//        $reviewsCrmAsUser = $this->actingAs($user)->get('/crm/reviews');
//        $reviewsCrmAsUser->assertStatus(302);
//
//        $callbacksCrmAsGuest = $this->get('/crm/callbacks');
//        $callbacksCrmAsGuest->assertStatus(302);
//
//    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCrmRoutesWithRights()
    {
        $admin = User::firstWhere('role_id', Role::ADMIN);

        $crmAsAdmin = $this->actingAs($admin)->get('/crm/');
        $crmAsAdmin->assertStatus(200);
    }
}
