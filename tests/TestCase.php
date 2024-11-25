<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as FakerFactory;

abstract class TestCase extends BaseTestCase
{
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = FakerFactory::create('id_ID');
    }
}
