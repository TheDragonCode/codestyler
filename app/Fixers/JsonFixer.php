<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Fixers;

use DragonCode\CodeStyler\Exceptions\ParsingException;
use DragonCode\Support\Facades\Helpers\Str;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use Seld\JsonLint\JsonParser;
use SplFileInfo;

use function json_decode;
use function json_encode;

class JsonFixer implements FixerInterface
{
    public function getName(): string
    {
        return 'DragonCode/json';
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
        $json = $tokens[0]->getContent() ?: '';

        if ($this->parser()->lint($json)) {
            throw new ParsingException($this->getName());
        }

        $tokens[0] = new Token([TOKEN_PARSE, $this->convert($json)]);
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Formats a JSON file with 4 spaces indented.', []);
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
        $encoded = json_encode(
            json_decode($json, false),
            JSON_UNESCAPED_UNICODE ^ JSON_UNESCAPED_SLASHES ^ JSON_PRETTY_PRINT
        );

        return trim($encoded) . PHP_EOL;
    }
}
