<?php

declare(strict_types=1);

// PHPUnit bootstrap — loaded before every test run

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Brain\Monkey setup for WordPress function mocks
\Brain\Monkey\setUp();
