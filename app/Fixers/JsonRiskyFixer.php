<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Fixers;

use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use Seld\JsonLint\JsonParser;
use Seld\JsonLint\ParsingException;
use SplFileInfo;

class JsonRiskyFixer implements FixerInterface
{
    public function getName(): string
    {
        return 'DragonCode/json_risky';
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    public function isRisky(): bool
    {
        return true;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        $json = $this->content($file);

        if ($this->parser()->lint($json)) {
            throw new ParsingException($this->getName());
        }

        $tokens[0] = new Token([TOKEN_PARSE, $this->convert($json)]);
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Formats a JSON file indented by 4 spaces and sorts the keys alphabetically.', []);
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return Str::lower($file->getExtension()) === 'json';
    }

    protected function content(SplFileInfo $file): string
    {
        return file_get_contents($file->getPathname()) ?: '';
    }

    protected function parser(): JsonParser
    {
        return new JsonParser();
    }

    protected function convert(string $json): string
    {
        return json_encode(
            $this->sort(json_decode($json, true)),
            JSON_UNESCAPED_UNICODE ^ JSON_UNESCAPED_SLASHES ^ JSON_PRETTY_PRINT
        );
    }

    protected function sort(array $items): array
    {
        return Arr::ksort($items);
    }
}
