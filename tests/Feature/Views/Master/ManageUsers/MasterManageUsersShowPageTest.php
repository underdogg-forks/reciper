<?php

namespace Tests\Feature\Views\Master\ManageUsers;

use App\Models\Ban;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MasterManageUsersShowPageTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    /**
     * @author Cho
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = create(User::class);
    }

    /**
     * @author Cho
     * @test
     */
    public function master_can_see_the_page(): void
    {
        $this->actingAs(create_user('master'))
            ->get("/master/manage-users/{$this->user->id}")
            ->assertViewIs('master.manage-users.show');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_cant_view_the_page(): void
    {
        $this->actingAs(create_user('admin'))
            ->get("/master/manage-users/{$this->user->id}")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function user_cant_view_the_page(): void
    {
        $this->actingAs(make(User::class))
            ->get("/master/manage-users/{$this->user->id}")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function master_can_ban_user(): void
    {
        $data = ['days' => 1, 'message' => str_random(40)];

        $this->actingAs(create_user('master'))
            ->put(action('Master\ManageUsersController@update', [
                'id' => $this->user->id,
            ]), $data);

        $this->assertDatabaseHas('ban', [
            'user_id' => $this->user->id,
            'days' => $data['days'],
            'message' => $data['message'],
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function master_can_unban_user(): void
    {
        Ban::put($this->user->id, 2, 'This user is banned on 2 days');

        $this->actingAs(create_user('master'))
            ->delete(action('Master\ManageUsersController@destroy', [
                'user' => $this->user->id,
            ]));

        $this->assertDatabaseMissing('ban', ['user_id' => $this->user->id]);
    }
}
