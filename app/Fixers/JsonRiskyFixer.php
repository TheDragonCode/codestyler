<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Fixers;

use DragonCode\CodeStyler\Exceptions\ParsingException;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use Seld\JsonLint\JsonParser;
use SplFileInfo;

class JsonRiskyFixer implements FixerInterface
{
    public function getName(): string
    {
        return 'DragonCode/json_ksort';
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
        $json = $tokens[0]->getContent() ?: '';

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
