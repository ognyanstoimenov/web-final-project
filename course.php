<?php
include 'lecture.php';
class Course {
    protected $lectures  = [];

    function __construct() {

        for ($i = 0; $i < 16; $i++) {
            $this->lectures[] = Lecture([]);
        }       

    }   

    function getAttendance() {

        return $presentPeople;
    }

}
?>