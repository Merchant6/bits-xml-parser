<?php

namespace App\Utility;

class XmlToDatabase
{   
    protected XmlIterator $iterator;

    public function __construct(string $filepath)
    {
        $this->iterator = new XmlIterator($filepath);
    }

    public function saveBookIdToDb()
    {   
        $infoToArray = json_decode($this->iterator->bookId(), true);
        $infoToArray['book-id'];

        //save the book id value to DB
    }

    public function saveBookIdAttributes()
    {   
        $attributes = $this->iterator->bookIdAttributes();
        $key = $attributes['key'];
        $value = $attributes['value'];

        //save the book id attributes, key and value to DB
    }

    public function saveBookTitleGroup()
    {
        $infoToArray = json_decode($this->iterator->bookTitleGroup(), true); 
        $infoToArray['book-title-group']['book-title'];

        //save the book title group value to DB
    }

    public function saveContribGroup()
    {
        $infoToArray = json_decode($this->iterator->contribGroup(), true);
        $contribGroup = $infoToArray['contrib-group']['contrib'];
        $surname = $contribGroup['name']['surname'];
        $givenNames = $contribGroup['name']['given-names'];
        
        //save contrib group values to DB
    }

    public function saveContribGroupContribAttributes()
    {
        $attributes = $this->iterator->contribGroupContribAttributes();
        $key = $attributes['key'];
        $value = $attributes['value'];

        //save contrib group, contrib attibutes
    }

    public function savePubDate()
    {
       
    }
}
