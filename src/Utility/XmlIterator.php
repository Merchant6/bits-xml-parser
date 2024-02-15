<?php

namespace App\Utility;
use SimpleXMLElement;

class XmlIterator
{   
    public string $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function parse() : array
    {
        $xml = simplexml_load_file($this->filepath);

        $xmlElements = [];
        for($xml->rewind(); $xml->valid(); $xml->next())
        {
            foreach($xml->getChildren() as $name => $data)
            {
                $xmlElements[$name] = $data;
            }
        }

        return $xmlElements;
    }

    public function getAttributes()
    {
        $parsedXml = $this->parse();

        return $parsedXml['book-id'];
    }
}
