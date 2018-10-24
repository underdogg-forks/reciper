<?php

namespace Tests\Feature\Views\Settings\General;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SettingsGeneralIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_see_the_page(): void
    {
        $this->actingAs(make(User::class))
            ->get('/settings/general')
            ->assertOk()
            ->assertViewIs('settings.general.index');
    }

    /** @test */
    public function guest_cant_see_the_page(): void
    {
        $this->get('/settings/general')->assertRedirect();
    }

    /** @test */
    public function user_can_update_his_name(): void
    {
        $user = create_user();
        $new_name = str_random(7);

        $this->actingAs($user)->put(action('Settings\GeneralController@updateGeneral'), [
            'name' => $new_name,
        ]);
        $this->assertEquals($new_name, $user->name);
    }

    /** @test */
    public function user_can_change_about_me_information(): void
    {
        $user = create_user();
        $status = str_random(10);

        $this->actingAs($user)->put(action('Settings\GeneralController@updateGeneral'), [
            'name' => $name = str_random(7),
            'status' => $status = str_random(7),
        ]);

        $this->assertEquals($name, $user->name);
        $this->assertEquals($status, $user->status);
    }

    /** @test */
    public function user_can_change_his_pwd(): void
    {
        $this->actingAs($user = create_user())
            ->put(action('Settings\GeneralController@updatePassword'), [
                'old_password' => '111111',
                'password' => 'new_password',
                'password_confirmation' => 'new_password',
            ]);

        $this->assertTrue(\Hash::check('new_password', $user->password), 'Passwords are not maching');
    }

    /**
     * ['m' => 'd'] doent metter for request
     * @test
     * */
    public function user_can_deactivate_account(): void
    {
        $this->actingAs(create_user())
            ->delete(action('UsersController@destroy', ['m' => 'd']), ['password' => '111111'])
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_cant_deactivate_account_with_wrong_password(): void
    {
        $this->actingAs($user = create_user())
            ->followingRedirects()
            ->delete(action('UsersController@destroy', ['m' => 'd']), ['password' => '22222'])
            ->assertSeeText(trans('settings.pwd_wrong'));
    }
}
