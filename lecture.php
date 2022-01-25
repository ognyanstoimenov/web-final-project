<?php
include 'users.php';
class Lecture {
    protected $presentPeople  = [];

    function __construct(array $users) {
        foreach($users as $row => $data)
        {
            $this->presentPeople[] = $data;
        }
    }   

    function getAttendance() {
        return $presentPeople;
    }

}
?>