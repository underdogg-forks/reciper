<?php

namespace Tests\Feature\Views\Users;

use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UsersShowPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function user_can_see_the_page(): void
    {
        $this->actingAs($user = create_user())
            ->get("/users/{$user->username}")
            ->assertOk()
            ->assertViewIs('users.show');
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_can_see_users_show_page(): void
    {
        $username = create_user()->username;
        $this->get("/users/{$username}")->assertOk();
    }

    /**
     * @author Cho
     * @test
     */
    public function noone_can_see_user_page_after_diactivating(): void
    {
        $user = create_user('', ['active' => 0]);
        $this->get("/users/{$user->username}")->assertSeeText(trans('users.user_is_not_active'));
    }

    /**
     * @author Cho
     * @test
     */
    public function user_sees_activate_account_form_when_is_not_active(): void
    {
        $user = create_user('', ['active' => 0]);

        $this->actingAs($user)
            ->get("/users/{$user->username}")
            ->assertSeeText(trans('users.activate_account_desc', [
                'days' => 30 - (date('j') - $user->updated_at->format('j')),
            ]));
    }

    /**
     * @author Cho
     * @test
     */
    public function user_does_not_see_activate_account_form_when_is_active(): void
    {
        $user = create_user();

        $this->actingAs($user)
            ->get("/users/{$user->username}")
            ->assertDontSee(trans('users.activate_account_desc', [
                'days' => 30 - (date('j') - $user->updated_at->format('j')),
            ]));
    }

    /**
     * @author Cho
     * @test
     */
    public function unactive_user_can_recover_account(): void
    {
        $user = create_user('', ['active' => 0]);

        $this->actingAs($user)
            ->post(action([UsersController::class, 'store']))
            ->assertRedirect("/users/{$user->username}");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => 1,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function if_user_not_found_redirect_to_users_with_message(): void
    {
        $this->get('/users/100')->assertRedirect('/users');

        $this->followingRedirects()
            ->get('/users/100')
            ->assertSeeText(trans('users.user_not_found'));
    }
}
