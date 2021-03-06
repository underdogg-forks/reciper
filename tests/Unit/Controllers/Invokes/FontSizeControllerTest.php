<?php

namespace Tests\Unit\Controllers\Invokes;

use Tests\TestCase;

class FontSizeControllerTest extends TestCase
{
    /**
     * @author Cho
     */
    public function setUp()
    {
        parent::setUp();
        cookie()->forget('r_font_size');
    }

    /**
     * @author Cho
     * @test
     */
    public function user_got_cookie_after_fontSizeSwitcher_request(): void
    {
        $this->get('invokes/font-size-switcher/1')->assertCookie('r_font_size');
    }
}
