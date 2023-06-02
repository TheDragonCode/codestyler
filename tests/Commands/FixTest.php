<?php

declare(strict_types=1);

namespace Tests\Commands;

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use Tests\TestCase;

class FixTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->prepare();
    }

    public function testFix(): void
    {
        $path = realpath(__DIR__.'/../../bin/codestyle');

        shell_exec("php $path fix");

        // $this->assertFileEquals(__DIR__.'/../Fixtures/styles/expected.json', __DIR__.'/../../tmp/actual.json');
        $this->assertFileEquals(__DIR__.'/../Fixtures/styles/expected.php', __DIR__.'/../../tmp/actual.php');
    }

    protected function prepare(): void
    {
        $source = __DIR__.'/../Fixtures/styles/';
        $target = __DIR__.'/../../tmp/';

        Directory::ensureDelete($target);

        File::copy($source.'actual.json', $target.'actual.json');
        File::copy($source.'actual.php', $target.'actual.php');
    }
}
