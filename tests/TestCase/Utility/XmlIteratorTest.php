<?php

namespace App\Test\TestCase\Utility;
use App\Utility\XmlIterator;
use Cake\TestSuite\TestCase;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use SimpleXMLElement;
use SimpleXMLIterator;

class XmlIteratorTest extends TestCase
{   
    public XmlIterator $xmlMock;

    public function setUp(): void
    {   
        parent::setUp();
        $loadedFile = "/home/merchant/paul-upwork/10.5117_9789463729352.xml";
        $this->xmlMock = new XmlIterator($loadedFile);
    }

    public function testParseReturnsAnArray(): void
    {   
        $parsedXml = $this->xmlMock->parse();

        $this->assertIsArray($parsedXml);
    }

    public function testParseIsNotEmpty(): void
    {
        $parsedXml = $this->xmlMock->parse();
        
        $this->assertNotEmpty($parsedXml);
    }

    public function testInfoAsJsonIsAString(): void
    {
        $json = $this->xmlMock->getInfoAsJson('book-id');
        
        $this->assertIsString($json);
    }

    public function testInfoAsJsonIsAValidJson(): void
    {
        $json = $this->xmlMock->getInfoAsJson('book-id');

        $this->assertJson($json);
    }

    public function testInfoAsJsonIsNoEmpty(): void
    {
        $json = $this->xmlMock->getInfoAsJson('book-id');

        $this->assertNotEmpty($json); 
    }

    public function testGetAttributesReturnsAnArray(): void
    {
        $attributes = $this->xmlMock->getAttributes('book-meta/contrib-group/contrib/@*');

        $this->assertIsArray($attributes);
    }

    public function testGetAttributesIsNotEmpty(): void
    {
        $attributes = $this->xmlMock->getAttributes('book-meta/contrib-group/contrib/@*');
        
        $this->assertNotEmpty($attributes);
    }

}
