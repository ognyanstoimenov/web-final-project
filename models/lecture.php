<?php
class Lecture {
    //protected array $lecturePortions  = [];
    //protected $date ;
    //
    //function __construct(array $lectures,string $date) {
    //
    //    foreach($lectures as $row => $data)
    //    {
    //        $this->lecturePortions[] = $data;
    //    }
    //    $this->date = $date;
    //}

    private int $lecture_id;
    private string $name;

    public function __construct($lecture_id, $name)
    {
        $this->lecture_id = $lecture_id;
        $this->name = $name;
    }

    public function getLectureId(): int
    {
        return $this->lecture_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
?>