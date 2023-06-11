<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Fixers;

use DOMDocument;
use DragonCode\CodeStyler\Helpers\XmlReader;
use DragonCode\Support\Facades\Helpers\Str;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

class XmlFixer implements FixerInterface
{
    protected array $extensions = ['.xml', '.xml.dist'];

    public function getName(): string
    {
        return 'DragonCode/xml';
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
        return new FixerDefinition('Formats a XML file with 2 spaces indented.', []);
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return Str::of($file->getPathname())->lower()->endsWith($this->extensions);
    }

    protected function parse(string $xml): DOMDocument
    {
        return XmlReader::fromXml($xml);
    }

    protected function encode(DOMDocument $document): string
    {
        return XmlReader::toXml($document);
    }
}
