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
        $json = $this->content($file);

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
            json_decode($json, false),
            JSON_UNESCAPED_UNICODE ^ JSON_UNESCAPED_SLASHES ^ JSON_PRETTY_PRINT
        );
    }
}
