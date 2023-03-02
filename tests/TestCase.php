<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, FactoryHelpers, DatabaseMigrations, WithFaker;

    protected bool $shouldRunSeeders = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();

        /**
         * Seed necessary data
         */
        if ($this->shouldRunSeeders) {
            $this->artisan('db:seed');
        }

        /**
         * Create a temporary storage path for testing
         */
        Storage::fake();
    }
}
