<?php

declare(strict_types=1);

namespace DragonCode\CodeStyler\Helpers;

use DOMDocument;

class XmlReader
{
    public static function load(string $path): DOMDocument
    {
        $document = static::dom();

        if (file_exists($path)) {
            $document->load($path, LIBXML_BIGLINES);
        }

        return $document;
    }

    public static function toXml(DOMDocument $document): string
    {
        return $document->saveXML();
    }

    protected static function dom(): DOMDocument
    {
        $document = new DOMDocument();

        $document->preserveWhiteSpace = false;
        $document->formatOutput       = true;
        $document->validateOnParse    = true;

        return $document;
    }
}
