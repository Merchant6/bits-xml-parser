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
    public MockObject|XmlIterator $xmlMock;

    public function setUp(): void
    {   
        parent::setUp();
        $loadedFile = "/home/merchant/paul-upwork/10.5117_9789463729352.xml";
        $this->xmlMock = $this->getMockBuilder(XmlIterator::class)
        ->setConstructorArgs([$loadedFile])
        ->disableOriginalConstructor()
        ->getMock();
    }

    public function testParseReturnsAnArray()
    {   
        $parsedXml = $this->xmlMock->parse();

        $this->assertIsArray($parsedXml);
    }

    public function testParseIsNotNull()
    {
        $parsedXml = $this->xmlMock->parse();
        
        $this->assertNotNull($parsedXml);
    }

    public function testInfoAsJsonIsAValidJson()
    {
        $json = $this->xmlMock->getInfoAsJson('book-id');
        
        $this->assertIsString($json);
    }
}
