<?php

namespace Tests\Feature\Views\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UsersIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test for users page. View: resources/views/users/index
     * @return void
     * @test
     */
    public function authUserCanSeeUsersIndexPage(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/users')
            ->assertOk()
            ->assertViewIs('users.index');
    }

    /**
     * Test for users page. View: resources/views/users/index
     * @return void
     * @test
     */
    public function guestCanSeeUsersIndexPage(): void
    {
        $this->get('/users')
            ->assertOk()
            ->assertViewIs('users.index');
    }
}