<?php

namespace Tests\Feature\Views\Settings\Photo;

use App\Jobs\DeleteFileJob;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Queue;
use Tests\TestCase;

class SettingsPhotoIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function user_can_see_the_page(): void
    {
        $this->actingAs(make(User::class))
            ->get('/settings/photo')
            ->assertOk()
            ->assertViewIs('settings.photo.index');
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_cant_see_the_page(): void
    {
        $this->get('/settings/photo')->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function user_can_upload_new_profile_photo(): void
    {
        $user = create_user();

        $this->actingAs($user)->put(action('Settings\PhotoController@update'), [
            'photo' => UploadedFile::fake()->image('image.jpg'),
        ]);
        $this->assertNotEquals('default.jpg', $user->photo);
        $this->assertFileExists(storage_path("app/public/big/users/{$user->photo}"));
        $this->assertFileExists(storage_path("app/public/small/users/{$user->photo}"));
        $this->cleanAfterYourself($user->photo);
    }

    /**
     * @author Cho
     * @test
     */
    public function delete_photo_request_dispaches_job_DeleteFileJob(): void
    {
        $this->expectsJobs(DeleteFileJob::class);

        $user = create_user('', ['photo' => 'some/image.jpg']);
        $this->actingAs($user)->delete(action('Settings\PhotoController@destroy'));
    }

    /**
     * @author Cho
     * @test
     */
    public function if_profile_photo_is_default_DeleteFileJob_is_not_queued(): void
    {
        Queue::fake();

        $this->actingAs(create_user())
            ->delete(action('Settings\PhotoController@destroy'));

        Queue::assertNotPushed(DeleteFileJob::class);
    }

    /**
     * @author Cho
     * @test
     */
    public function after_delete_photo_request_photo_column_is_set_to_default_jpg(): void
    {
        $user = create_user('', ['photo' => 'another/image.jpg']);

        $this->withoutJobs();
        $this->actingAs($user)->delete(action('Settings\PhotoController@destroy'));
        $this->assertEquals('default.jpg', $user->photo);
    }

    /**
     * Helper function
     * @auhor Cho
     * @param string $photo_path
     * @return void
     */
    private function cleanAfterYourself(string $photo_path): void
    {
        \Storage::delete([
            "public/big/users/{$photo_path}",
            "public/small/users/{$photo_path}",
        ]);
    }
}
