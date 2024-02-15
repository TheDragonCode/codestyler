<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Fixers;

use DragonCode\Support\Facades\Helpers\Str;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;
use Symfony\Component\Yaml\Yaml;

use function in_array;

class YamlFixer implements FixerInterface
{
    protected array $extensions = ['yaml', 'yml'];

    public function getName(): string
    {
        return 'DragonCode/yaml';
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        if ($content = $this->parse($tokens[0]->getContent())) {
            $tokens[0] = new Token([TOKEN_PARSE, $this->encode($content)]);
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Formats a YAML file with 4 spaces indented.', []);
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return in_array(Str::lower($file->getExtension()), $this->extensions);
    }

    protected function parse(string $yaml): ?array
    {
        return Yaml::parse($yaml);
    }

    protected function encode(array $data): string
    {
        $encoded = Yaml::dump($data, 5);

        return trim($encoded) . PHP_EOL;
    }
}
