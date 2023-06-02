<?php

declare(strict_types=1);

namespace Tests\Support;

use Tests\Fixtures\Support\PhpVersion;
use Tests\TestCase;

class PhpVersionTest extends TestCase
{
    public function test72(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0 || ^7.1',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ]);

        $version2 = $this->getVersion([
            'php' => '^8.0 || ^7.1.5',
        ]);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test72Dev(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0 || ^7.1',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ], true);

        $version2 = $this->getVersion([
            'php' => '^8.0 || ^7.1.5',
        ], true);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test74(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0 || ^7.4',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ]);

        $version2 = $this->getVersion([
            'php' => '^8.0 || ^7.4.5',
        ]);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test74Dev(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0 || ^7.4',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ], true);

        $version2 = $this->getVersion([
            'php' => '^8.0 || ^7.4.5',
        ], true);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test80(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ]);

        $version2 = $this->getVersion([
            'php' => '^8.0.5',
        ]);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test80Dev(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.0',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ], true);

        $version2 = $this->getVersion([
            'php' => '^8.0.5',
        ], true);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test81(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.1',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ]);

        $version2 = $this->getVersion([
            'php' => '^8.1.5',
        ]);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function test81Dev(): void
    {
        $version1 = $this->getVersion([
            'php' => '^8.1',
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ], true);

        $version2 = $this->getVersion([
            'php' => '^8.1.5',
        ], true);

        $this->assertSame('8.1', $version1);
        $this->assertSame('8.1', $version2);
    }

    public function testDefault(): void
    {
        $version1 = $this->getVersion([
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ]);

        $version2 = $this->getVersion([]);

        $this->assertSame('8.2', $version1);
        $this->assertSame('8.2', $version2);
    }

    public function testDefaultDev(): void
    {
        $version1 = $this->getVersion([
            'ext-json' => '*',
            'foo/bar' => '^1.0',
        ], true);

        $version2 = $this->getVersion([], true);

        $this->assertSame('8.2', $version1);
        $this->assertSame('8.2', $version2);
    }

    protected function getVersion(array $dependencies, bool $is_dev = false): string
    {
        $key = $is_dev ? 'require-dev' : 'require';

        return PhpVersion::make()->setComposer([
            $key => $dependencies,
        ])->get();
    }
}
