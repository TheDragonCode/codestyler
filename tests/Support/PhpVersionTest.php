<?php

declare(strict_types=1);

namespace Tests\Support;

use Tests\Fixtures\Support\PhpVersion;
use Tests\TestCase;

class PhpVersionTest extends TestCase
{
    public function test72(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require' => [
                'php'      => '^8.0 || ^7.1',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('7.2', $helper);
    }

    public function test72Dev(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require-dev' => [
                'php'      => '^8.0 || ^7.1',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('7.2', $helper);
    }

    public function test74(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require' => [
                'php'      => '^8.0 || ^7.4',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('7.4', $helper);
    }

    public function test74Dev(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require-dev' => [
                'php'      => '^8.0 || ^7.4',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('7.4', $helper);
    }

    public function test80(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require' => [
                'php'      => '^8.0',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.0', $helper);
    }

    public function test80Dev(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require-dev' => [
                'php'      => '^8.0',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.0', $helper);
    }

    public function test81(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require' => [
                'php'      => '^8.1',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.1', $helper);
    }

    public function test81Dev(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require-dev' => [
                'php'      => '^8.1',
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.1', $helper);
    }

    public function testDefault(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require' => [
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.1', $helper);
    }

    public function testDefaultDev(): void
    {
        $helper = PhpVersion::make()->setComposer([
            'require-dev' => [
                'ext-json' => '*',
                'foo/bar'  => '^1.0',
            ],
        ])->get();

        $this->assertSame('8.1', $helper);
    }
}
