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

    /**
     * Parses a XML files using the simplexml_load_file()
     * @return array
     */
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

    /**
     * Display the attributes, sub tags, and values
     * of the given tag
     * @param string $tagName
     * @return string
     */
    public function getInfoAsJson(string $tagName)
    {
        $parsedXml = $this->parse();
        return json_encode($parsedXml[$tagName], JSON_PRETTY_PRINT);
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

    public function getAttributes()
    {
        $xml = simplexml_load_file($this->filepath);
        $Xmlattributes = $xml->xpath("//@*");

        $attributes = [];
        foreach($Xmlattributes as $key => $value)
        {
            $attributes[$key] = $value;
        }

        print_r($attributes);
    
    }

}
