<?php

namespace Tests\Feature\Views\Users;

use App\Models\User;
use Tests\TestCase;

class UsersIndexPageTest extends TestCase
{
    /**
     * @author Cho
     * @test
     */
    public function view_has_data(): void
    {
        $this->actingAs(make(User::class))
            ->get('/users')
            ->assertViewIs('users.index')
            ->assertViewHas('users');
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_can_see_the_page(): void
    {
        $this->get('/users')->assertOk();
    }
}
