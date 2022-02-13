<?php 
class Student {
    protected $firstName = 'aMemberVar Member Variable';
    protected $lastName = 'aMemberFunc';

    function __construct(string $firstName, string $lastName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
     
    }   

    function getFirstName (){
        return  $this->firstName;
    }
    function getLastName (){
        return  $this->LastName;
    }


}
