<?php

declare(strict_types=1);

class Dependabot
{
    protected array $update = [
        'package-ecosystem' => 'github-actions',

        'directory' => '/',

        'schedule' => [
            'interval' => 'daily',
            'time'     => '00:00',
        ],
    ];

    protected array $content = [];

    protected int $version = 2;

    protected string $name = 'github-actions';

    public function __construct(
        protected string $path
    ) {
        $this->content = $this->parse();
    }

    public function handle(): void
    {
        $updates = $this->each($this->getUpdates());
        $version = $this->getVersion();

        $this->store($version, $updates);
    }

    protected function each(array $updates): array
    {
        $found = false;

        foreach ($updates as &$update) {
            if ($update['package-ecosystem'] === $this->name) {
                $update = $this->update;
                $found  = true;
                break;
            }
        }

        return $found ? $updates : $this->put($updates);
    }

    protected function put(array $updates): array
    {
        $updates[] = $this->update;

        return $updates;
    }

    protected function store(int $version, array $updates): void
    {
        yaml_emit_file($this->path, compact('version', 'updates'));
    }

    protected function getUpdates(): array
    {
        return $this->content['updates'] ?? [];
    }

    protected function getVersion(): int
    {
        return $this->version;
    }

    protected function parse(): array
    {
        return $this->exists() ? yaml_parse_file($this->path) : [];
    }

    protected function exists(): bool
    {
        return file_exists($this->path);
    }
}

$dependabot = new Dependabot('./.github/dependabot.yml');

$dependabot->handle();
