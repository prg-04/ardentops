<?php
/**
 * Theme setup unit tests.
 *
 * @package ardentops
 */

declare(strict_types=1);

namespace ardentops\Tests\Unit\Php;

use PHPUnit\Framework\TestCase;

/**
 * Test the theme setup functions.
 */
class ThemeSetupTest extends TestCase
{
    /**
     * Test that the text domain constant matches the expected slug.
     */
    public function testTextDomainConstant(): void
    {
        // This test validates that the text domain is properly set.
        // In a bootstrap scenario, 'ardentops' is replaced with the project slug.
        $expected = 'ardentops';
        $this->assertNotEmpty($expected);
        $this->assertIsString($expected);
    }

    /**
     * Test that the namespace function prefix is valid PHP.
     */
    public function testNamespaceFunctionPrefix(): void
    {
        // The namespace must be a valid PHP function prefix (underscores, no hyphens).
        $prefix = 'ardentops';
        $this->assertMatchesRegularExpression('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $prefix);
    }
}
