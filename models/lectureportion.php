<?php
class LecturePortion {
    protected array $presentPeople  = [];
    protected $date ;
    protected $id;

    function __construct(int $id, array $users,DateTime $date) {

        foreach($users as $row => $data)
        {
            $this->presentPeople[] = $data;
        }
        $this->date = $date;
        $this->id = $id;
    }

    function getAttendance() {

        return $this->presentPeople;
    }

    function getDate()
    {
        return $this->date;
    }

    function hasStudentAttended(Student $student): bool
    {
        return in_array($student, $this->presentPeople);
    }

    function getId()
    {
        return $this->id;
    }

}
?>