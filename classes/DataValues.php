<?php
namespace Riuson\RssReader\Classes;

use Carbon\Carbon;

class DataValues
{

    public function __construct(\DOMXPath $domPath, $rootNode)
    {
        $values = array();

        // select nodes without childs and attributes
        $simpleNodes = $domPath->query('child::*[not(*)]', $rootNode);

        foreach ($simpleNodes as $simpleNode) {
            if ($simpleNode->attributes->length == 0) {
                // printf("%s - %d\n", $simpleNode->nodeName, $simpleNode->attributes->length);
                // printf(" %d \n", $simpleNode->childNodes->length);

                // collect key-value pairs
                $values[$simpleNode->nodeName] = $simpleNode->nodeValue;
                $matches = array();

                if ($simpleNode->nodeName == 'pubDate' ||
                    $simpleNode->nodeName == 'lastBuildDate') {
                    $values[$simpleNode->nodeName] = new Carbon($simpleNode->nodeValue);
                }
            }
        }

        $this->mValues = $values;
    }

    private $mValues;

    public function all()
    {
        return $this->mValues;
    }

    public function byName($name)
    {
        if (array_key_exists($name, $this->mValues)) {
            return $this->mValues[$name];
        }

        return NULL;
    }
}