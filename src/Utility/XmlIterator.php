<?php

namespace App\Utility;
use SimpleXMLElement;
use SimpleXMLIterator;
use App\Utility\XmlToDatabase;

class XmlIterator
{   
    public SimpleXMLElement|SimpleXMLIterator $xml;

    public function __construct(string $filepath)
    {
        $this->xml = simplexml_load_file($filepath);
    }

    /**
     * Parses a XML files using the simplexml iterator
     * @return array
     */
    public function parse() : array
    {
        $xml = $this->xml;

        $xmlElements = [];
        $usedNames = [];

        for($xml->rewind(); $xml->valid(); $xml->next())
        {
            foreach($xml->getChildren() as $name => $data)
            {
                if (in_array($name, $usedNames)) 
                {
                    $index = 2;
                    while (in_array("$name-$index", $usedNames)) 
                    {
                        $index++;
                    }
                    $name = "$name-$index";
                }

                $xmlElements[$name] = $data;

                $usedNames[] = $name;
            }
        }
        return $xmlElements;
    }

    /**
     * Display the attributes, sub tags, and values
     * of the given tag
     * @param string $tagName
     * @return string
     */
    public function getInfoAsJson(string $tagName)
    {
        $parsedXml = $this->parse();

        $matchedElements = [];
        foreach ($parsedXml as $name => $data) 
        {
            // Use regex to match the tag name with or without an index
            if (preg_match("/^$tagName(?:-\d+)?(.+)?$/", $name)) 
            {
                $matchedElements[$name] = $data;
            }
        }

        return json_encode($matchedElements, JSON_PRETTY_PRINT);
    }
    
    /**
     * Placeholder method for getInfoAsJson to
     * return book-id tag
     * @return string
     */
    public function bookId(): string
    {
        return $this->getInfoAsJson('book-id');
    }

    public function bookTitleGroup(): string
    {
        return $this->getInfoAsJson('book-title-group');
    }

    public function contribGroup(): string
    {
        return $this->getInfoAsJson('contrib-group');
    }

    public function pubDate(): string
    {
        return $this->getInfoAsJson('pub-date');
    }

    public function isbn(): string
    {
        return $this->getInfoAsJson('isbn');
    }

    public function publisher(): string
    {
        return $this->getInfoAsJson('publisher');
    }

    public function permissions(): string
    {
        return $this->getInfoAsJson('permissions');
    }

    public function abstract(): string
    {
        return $this->getInfoAsJson('abstract');   
    }

    public function bookPart(): string
    {
        return $this->getInfoAsJson('book-part');
    }

    private function getAttributes($xpath)
    {
        $xml = $this->xml;
        $XmlAttributes = $xml->xpath("//$xpath");

        $attributes = [];

        $attributesCount = count($XmlAttributes);
        if($attributesCount > 1)
        {   
            for ($i = 0; $i < $attributesCount; $i++) {
                $attribute = $XmlAttributes[$i];
                foreach ($attribute as $key => $value) {
                    $attributes['key-' . $i] = $key;
                    $attributes['value-'. $i] = $value;
                }
            }

            return $attributes;
        }
        
        foreach($XmlAttributes as $attribute) 
        {
            foreach ($attribute as $key => $value) 
            {
                $attributes['key'] = $key;
                $attributes['value'] = $value;
            }
        }

        return $attributes;
    }

    public function bookIdAttributes()
    {
        return $this->getAttributes("book-meta/book-id/@*");
    }

    public function contribGroupContribAttributes()
    {
        return $this->getAttributes("book-meta/contrib-group/contrib/@*");
    }

    public function pubDateAttributes()
    {
        return $this->getAttributes("book-meta/pub-date/@*");
    }

    public function isbnAttributes()
    {
        return $this->getAttributes("book-meta/isbn/@*");
    }
    
    public function bookPartAttributes()
    {
        return $this->getAttributes("book-body/book-part/@*");
    }

    public function bookBodyBookIdAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/book-part-id/@*");
    }

    public function bookPartContribGroupContribAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/@*");
    }

    public function bookPartContribGroupContribBioAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/bio/@*");
    }

    public function bookPartContribGroupContribXrefAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/xref/@*");
    }

    public function bookPartAffAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/aff/@*");
    }

    public function bookPartPubDateAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/pub-date/@*");
    }

    public function bookPartAbstractAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/abstract/@*");
    }

    public function bookPartKwdGroupAttributes()
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/kwd-group/@*");
    }
    
}
