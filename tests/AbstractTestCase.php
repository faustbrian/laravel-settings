<?php

namespace BrianFaust\Tests\Settings;

use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass($app)
    {
        return \BrianFaust\Settings\ServiceProvider::class;
    }
}
