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

class ExtraWhitespacesInSingleLineAnonymousFunction implements FixerInterface
{
    public function getName(): string
    {
        return 'DragonCode/extra_whitespaces_in_single_line_anonymous_function';
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAnyTokenKindsFound([T_FUNCTION]);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = $tokens->count() - 1; $index > 0; $index--) {
            if (! $tokens[$index]->isGivenKind(T_FUNCTION)) {
                continue;
            }

            $newContent = preg_replace_callback(
                '/(?P<name>function|fn)\s*\(\)\s*(?P<use>use\s*\(.+\))?\s+(?P<open>\{|=>)(?P<content>.+)(?P<close>[;|\}|\)])/ux',
                fn (array $matches) => $this->trim($matches['name']) . ' () '
                    . $this->trim($matches['use'] ?? '')
                    . $this->trim($matches['open']) . ' '
                    . $this->trim($matches['content'])
                    . $this->trim($matches['close']),
                $tokens[$index]->getContent()
            );

            if ($newContent == $tokens[$index]->getContent()) {
                continue;
            }

            $tokens[$index] = new Token([T_FUNCTION, $newContent]);
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('Single line functions must not contain more than two whitespaces in a row.', []);
    }

    public function getPriority(): int
    {
        return -42;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }

    protected function trim(string $value): string
    {
        return Str::of($value)->trim()->squish()->toString();
    }
}
