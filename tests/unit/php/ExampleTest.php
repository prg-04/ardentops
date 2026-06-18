<?php

declare(strict_types=1);

namespace ArdentOps\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

/**
 * ExampleTest
 *
 * Delete this file once real tests exist.
 * Purpose: validates that PHPUnit + Brain\Monkey bootstrap works.
 */
class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    public function test_phpunit_scaffold_is_working(): void
    {
        $this->assertTrue(true, 'PHPUnit bootstrap is operational.');
    }

    public function test_brain_monkey_can_mock_wp_functions(): void
    {
        Monkey\Functions\expect('get_option')
            ->once()
            ->with('ardentops_setting')
            ->andReturn('expected_value');

        $result = get_option('ardentops_setting');

        $this->assertSame('expected_value', $result);
    }
}
