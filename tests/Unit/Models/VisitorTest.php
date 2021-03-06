<?php

namespace Tests\Unit\Models;

use App\Models\Visitor;
use Tests\TestCase;

class VisitorTest extends TestCase
{
    /**
     * @author Cho
     * @test
     */
    public function visitor_model_has_attributes(): void
    {
        $this->assertClassHasAttribute('timestamps', Visitor::class);
    }
}
