<?php

namespace Tests\Feature\Views\Documents;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MasterDocumentsEditPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function master_can_see_the_page(): void
    {
        $this->actingAs(create_user('master'))
            ->get("/documents/1/edit")
            ->assertOk()
            ->assertViewIs('documents.edit');
    }

    /**
     * @author Cho
     * @test
     */
    public function user_cannot_see_the_page(): void
    {
        $this->actingAs(make(User::class))
            ->get("/documents/1/edit")
            ->assertRedirect();
    }
}
