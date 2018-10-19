<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MiddlewaresTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function online_check_is_updated_to_now_after_user_visits_the_app(): void
    {
        $this->actingAs($user = create_user('', ['online_check' => now()->subWeek()]))->get('/');

        $actual = date("Y-m-d H-i", strtotime(User::whereId($user->id)->value('online_check')));
        $this->assertEquals(now()->format('Y-m-d H-i'), $actual);
    }

    /** @test */
    public function online_check_is_updated_after_5_minutes(): void
    {
        $this->actingAs($user = create_user('', ['online_check' => now()->subMinutes(5)]))->get('/');
        $now = now();
        $this->assertDatabaseHas('users', ['id' => $user->id, 'online_check' => $now]);
    }

    /** @test */
    public function online_check_is_not_updated_after_first_visit_within_5_minutes(): void
    {
        $user = create_user();

        for ($i = 1; $i < 5; $i++) {
            $date = now()->subMinutes($i);
            $user->update(['online_check' => $date]);
            $this->actingAs($user)->get('/');
            $this->assertDatabaseHas('users', ['id' => $user->id, 'online_check' => $date]);
        }
    }
}
