<?php
namespace Riuson\RssReader\Classes;

use Carbon\Carbon;

class DataValues
{

    public function __construct(\DOMXPath $domPath, $rootNode, $dateFormat)
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

                if ($simpleNode->nodeName == 'pubDate' || $simpleNode->nodeName == 'lastBuildDate') {

                    // replace UT by UTC
                    $pattern = '/UT$/i';
                    $replacement = 'UTC';
                    $subject = 'Sun, 08 Feb 2015 06:51:58 UTC';
                    $dateString = preg_replace($pattern, $replacement, $simpleNode->nodeValue, - 1);

                    if (empty($dateFormat)) {
                        $values[$simpleNode->nodeName] = new Carbon($dateString);
                    } else {
                        $values[$simpleNode->nodeName] = Carbon::createFromFormat($dateFormat, $dateString);
                    }
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