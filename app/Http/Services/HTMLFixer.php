<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/31/2017
 * Time: 9:49 PM
 */

namespace App\Http\Services;

use DOMNode;
use DOMDocument;
use DOMText;

class HTMLFixer extends DOMDocument
{
    protected static $defaultAllowedTags = [
        'p',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'pre',
        'code',
        'blockquote',
        'q',
        'strong',
        'em',
        'del',
        'img',
        'a',
        'table',
        'thead',
        'tbody',
        'tfoot',
        'tr',
        'th',
        'td',
        'ul',
        'ol',
        'li',
    ];
    protected static $defaultAllowedAttributes = [
        'a' => ['href'],
        'img' => ['src'],
        'pre' => ['class'],
    ];
    protected static $defaultForceAttributes = [
        'a' => ['target' => '_blank'],
    ];

    protected $allowedTags = [];
    protected $allowedAttributes = [];
    protected $forceAttributes = [];

    public function __construct($version = null, $encoding = null, $allowedTags = [],
                                $allowedAttributes = [], $forceAttributes = [])
    {
        $this->setAllowedTags($allowedTags ?: static::$defaultAllowedTags);
        $this->setAllowedAttributes($allowedAttributes ?: static::$defaultAllowedAttributes);
        $this->setForceAttributes($forceAttributes ?: static::$defaultForceAttributes);
        parent::__construct($version, $encoding);
    }

    public function setAllowedTags(Array $tags)
    {
        $this->allowedTags = $tags;
    }

    public function setAllowedAttributes(Array $attributes)
    {
        $this->allowedAttributes = $attributes;
    }

    public function setForceAttributes(Array $attributes)
    {
        $this->forceAttributes = $attributes;
    }

    public function getAllowedTags()
    {
        return $this->allowedTags;
    }

    public function getAllowedAttributes()
    {
        return $this->allowedAttributes;
    }

    public function getForceAttributes()
    {
        return $this->forceAttributes;
    }

    public function saveHTML(DOMNode $node = null)
    {
        if (!$node) {
            $node = $this;
        }
        $this->stripTags($node);
        return parent::saveHTML($node);
    }

    protected function stripTags(DOMNode $node)
    {
        $change = $remove = [];
        foreach ($this->walk($node) as $n) {
            if ($n instanceof DOMText || $n instanceof DOMDocument) {
                continue;
            }
            $this->stripAttributes($n);
            $this->forceAttributes($n);
            if (!in_array($n->nodeName, $this->allowedTags, true)) {
                $remove[] = $n;
                foreach ($n->childNodes as $child) {
                    $change[] = [$child, $n];
                }
            }
        }
        foreach ($change as list($a, $b)) {
            $b->parentNode->insertBefore($a, $b);
        }
        foreach ($remove as $a) {
            if ($a->parentNode) {
                $a->parentNode->removeChild($a);
            }
        }
    }

    protected function stripAttributes(DOMNode $node)
    {
        $attributes = $node->attributes;
        $len = $attributes->length;
        for ($i = $len - 1; $i >= 0; $i--) {
            $attr = $attributes->item($i);
            if (!isset($this->allowedAttributes[$node->nodeName]) ||
                !in_array($attr->name, $this->allowedAttributes[$node->nodeName], true)) {
                $node->removeAttributeNode($attr);
            }
        }
    }

    protected function forceAttributes(DOMNode $node)
    {
        if (isset($this->forceAttributes[$node->nodeName])) {
            foreach ($this->forceAttributes[$node->nodeName] as $attribute => $value) {
                $node->setAttribute($attribute, $value);
            }
        }
    }

    protected function walk(DOMNode $node, $skipParent = false)
    {
        if (!$skipParent) {
            yield $node;
        }
        if ($node->hasChildNodes()) {
            foreach ($node->childNodes as $n) {
                yield from $this->walk($n);
            }
        }
    }
}