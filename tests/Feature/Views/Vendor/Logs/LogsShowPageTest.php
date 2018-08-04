<?php

namespace Tests\Feature\Views\Vendor\Logs;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogsShowPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test for log page. View: resources/vendor/log-viewer/custom-theme/show
     * @return void
     * @test
     */
    public function masterCanSeeLogsShowsPage(): void
    {
        info('test');
        $file_name = date('Y-m-d');

        $this->actingAs(factory(User::class)->create(['master' => 1]))
            ->get("/log-viewer/logs/$file_name/info")
            ->assertSeeText($file_name);
    }
}