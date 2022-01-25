<?php 
class User {
    protected $firstName = 'aMemberVar Member Variable';
    protected $lastName = 'aMemberFunc';
    protected $identification = '';
    protected $fullAttendance = false;

    function __construct(string $firstName, string $lastName, string $identification) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->identification = $identification;
        $this->fullAttendance = false;
    }   

    function getFirstName (){
        return  $this->firstName;
    }
    function getLastName (){
        return  $this->LastName;
    }
    function getIdentification () {
        return  $this->identification;
    }

    function checkFullAttendance () {
        //TODO Check with db for attendance in all lectures
        return  $this->identification;
    }

    function getFullAttendance () {
        return  $this->fullAttendance;
    }

}
