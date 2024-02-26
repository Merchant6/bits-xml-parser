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
        $bookId = $infoToArray['book-id'];

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
        $bookTitle = $infoToArray['book-title-group']['book-title'];

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

        //save contrib group, contrib attibutes to db
    }

    public function savePubDate()
    {
        $infoToArray = json_decode($this->iterator->pubDate(), true);

        $year = $infoToArray['pub-date']['year'];
        $month = $infoToArray['pub-date']['month'];
        $day = $infoToArray['pub-date']['day'];

        //save pub dates value to DB
    }

    public function savePubDateAttributes()
    {
        $attributes = $this->iterator->pubDateAttributes();

        /**
         * As pub date attributes return 2 key value pair
         * we need to use for each to save them in to DB
         */
        foreach($attributes as $key => $value)
        {
    
        }
    }

    public function saveIsbn()
    {
        $infoToArray = json_decode($this->iterator->isbn(), true);

        foreach($infoToArray as $isbn)
        {   
            /**
             * $value contains the individual isbn
             * for each of the isbn tags
             */
            $value = $isbn[0];

            //save isbn value to DB
        }
    }

    public function saveIsbnAttributes()
    {
        $attributes = $this->iterator->isbnAttributes();

        foreach($attributes as $key => $value)
        {
            echo "$key: $value" . PHP_EOL;
        }
    }

    public function savePublisher()
    {
        $infoToArray = json_decode($this->iterator->publisher(), true);

        $publisherName = $infoToArray['publisher']['publisher-name'];
        $publisherLoc = $infoToArray['publisher']['publisher-loc'];
        $addrLine = $publisherLoc['addr-line'];
        $postalCode = $publisherLoc['postal-code'];
        $city = $publisherLoc['city'];
        $country = $publisherLoc['country'];

        //save publisher value to DB
    
    }

    public function savePermissions()
    {
        $infoToArray = json_decode($this->iterator->permissions(), true);

        $copyrightStatement = $infoToArray['permissions']['copyright-statement'];
        $copyrightYear = $infoToArray['permissions']['copyright-year'];

        //save permission values to db
    }

    public function saveAbstract()
    {
        $infoToArray = json_decode($this->iterator->abstract(), true);

        $paragraph = $infoToArray['abstract']['p'];

        //save abstract value to DB
    }

    public function saveBookParts()
    {
        $infoToArray = json_decode($this->iterator->bookPart(), true);

        /**
         * bookPart() returns 10 individual book
         * parts contained in the given XML file
         * it's upon you to determine what approach
         * is better to save thes individual parts
         */
        json_encode($infoToArray, JSON_PRETTY_PRINT);

        //save book part values to DB
    }

    public function saveBookPartAttributes()
    {
        $attributes = $this->iterator->bookPartAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        }
    }

    public function saveBookBodyBookIdAttributes()
    {
        $attributes = $this->iterator->bookBodyBookIdAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        }
    }

    public function saveBookPartContribGroupContribAttributes()
    {
        $attributes = $this->iterator->bookPartContribGroupContribAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        }
    }

    public function saveBookPartContribGroupContribBioAttributes()
    {
        $attributes = $this->iterator->bookPartContribGroupContribBioAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }

    public function saveBookPartContribGroupContribXrefAttributes()
    {
        $attributes = $this->iterator->bookPartContribGroupContribXrefAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }

    public function saveBookPartAffAttributes()
    {   
        $attributes = $this->iterator->bookPartAffAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }

    public function saveBookPartPubDateAttributes()
    {   
        $attributes = $this->iterator->bookPartPubDateAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }

    public function saveBookPartKwdGroupAttributes()
    {   
        $attributes = $this->iterator->bookPartKwdGroupAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }
    
    public function saveBookPartAbstractAttributes()
    {   
        $attributes = $this->iterator->bookPartAbstractAttributes();

        foreach($attributes as $key => $value)
        {
            //save book part attributes to DB
        } 
    }
}
