<?php
require_once __DIR__ . '/../models/coursetype.php';
class Course {

    private int $course_id;
    private string $name;
    private string $courseType;

    public function __construct($id, $name, $courseType)
    {
        $this->course_id = $id;
        $this->name = $name;
        switch ($courseType) {
            case "Z":
                $courseType = CourseType::$Z;
                break;
            case "I":
                $courseType = CourseType::$I;
                break;
        }
        $this->courseType = $courseType;
    }

    public function getCourseId(): int
    {
        return $this->course_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCourseType(): string
    {
        return $this->courseType;
    }
}
