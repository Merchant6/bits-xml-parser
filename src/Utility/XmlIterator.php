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

    /**
     * Placeholder method for getInfoAsJson to
     * return book title group
     * @return string
     */
    public function bookTitleGroup(): string
    {
        return $this->getInfoAsJson('book-title-group');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return contrib-group
     * @return string
     */
    public function contribGroup(): string
    {
        return $this->getInfoAsJson('contrib-group');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return pub-date
     * @return string
     */
    public function pubDate(): string
    {
        return $this->getInfoAsJson('pub-date');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return isbn
     * @return string
     */
    public function isbn(): string
    {
        return $this->getInfoAsJson('isbn');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return publisher
     * @return string
     */
    public function publisher(): string
    {
        return $this->getInfoAsJson('publisher');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return permissions
     * @return string
     */
    public function permissions(): string
    {
        return $this->getInfoAsJson('permissions');
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return abstract
     * @return string
     */
    public function abstract(): string
    {
        return $this->getInfoAsJson('abstract');   
    }

    /**
     * Placeholder method for getInfoAsJson to
     * return book-part
     * @return string
     */
    public function bookPart(): string
    {
        return $this->getInfoAsJson('book-part');
    }

    /**
     * Lists all the attriutes of a given tag
     * @param string $xpath Xpath to a specified tag
     * @return array
     */
    public function getAttributes(string $xpath): array
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

    /**
     * Placeholder method for getAttributes to
     * return book-id attributes
     * @return array
     */
    public function bookIdAttributes(): array
    {
        return $this->getAttributes("book-meta/book-id/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return contrib-group/contrib attributes
     * @return array
     */
    public function contribGroupContribAttributes(): array
    {
        return $this->getAttributes("book-meta/contrib-group/contrib/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return pub-date attributes
     * @return array
     */
    public function pubDateAttributes(): array
    {
        return $this->getAttributes("book-meta/pub-date/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return isbn attributes
     * @return array
     */
    public function isbnAttributes(): array
    {
        return $this->getAttributes("book-meta/isbn/@*");
    }
    
    /**
     * Placeholder method for getAttributes to
     * return book-part attributes
     * @return array
     */
    public function bookPartAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part-id attributes
     * @return array
     */
    public function bookBodyBookIdAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/book-part-id/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part-meta/contrib-group/contrib/ attributes
     * @return array
     */
    public function bookPartContribGroupContribAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part-meta/contrib-group/contrib/bio attributes
     * @return array
     */
    public function bookPartContribGroupContribBioAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/bio/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part-meta/contrib-group/contrib/xref attributes
     * @return array
     */
    public function bookPartContribGroupContribXrefAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/contrib-group/contrib/xref/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return aff attributes
     * @return array
     */
    public function bookPartAffAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/aff/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part/pub-date attributes
     * @return array
     */
    public function bookPartPubDateAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/pub-date/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return book-part-meta/abstract attributes
     * @return array
     */
    public function bookPartAbstractAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/abstract/@*");
    }

    /**
     * Placeholder method for getAttributes to
     * return kwd-group attributes
     * @return array
     */
    public function bookPartKwdGroupAttributes(): array
    {
        return $this->getAttributes("book-body/book-part/book-part-meta/kwd-group/@*");
    }
    
}
