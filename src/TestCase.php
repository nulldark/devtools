<?php

namespace Nulldark\DevTools;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;

class TestCase extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;

    public function mock(string $class, mixed ...$arguments): MockInterface
    {
        return Mockery::mock($class, $arguments);
    }

    public function spy(string $class, mixed ...$arguments): MockInterface
    {
        return Mockery::spy($class, ...$arguments);
    }
}