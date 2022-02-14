<?php
include 'users.php';
class Lecture {
    protected array $lecturePortions  = [];
    protected $date ;

    function __construct(array $lectures,string $date) {

        foreach($lectures as $row => $data)
        {
            $this->lecturePortions[] = $data;
        }
        $this->date = $date;
    }

}
?>