<?php
include 'users.php';
class LecturePortion {
    protected $presentPeople  = [];
    protected $date ;

    function __construct(array $users,string $date) {

        foreach($users as $row => $data)
        {
            $this->presentPeople[] = $data;
        }
        $this->date = $date;
    }   

    function getAttendance() {

        return $presentPeople;
    }

}
?>