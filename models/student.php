<?php 
class Student {
    protected $firstName = 'aMemberVar Member Variable';
    protected $lastName = 'aMemberFunc';
    protected $id;


    function __construct(int $id, string $firstName, string $lastName) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
     
    }   

    function getStudentId()
    {
        return $this->id;
    }

    function getFirstName (){
        return  $this->firstName;
    }
    function getLastName (){
        return  $this->lastName;
    }


}
