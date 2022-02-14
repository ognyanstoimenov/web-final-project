<?php
require_once __DIR__ . '/../models/lecture.php';

class LectureService {
    private Db $db;
    private int $currentCourseId;

    private array $lectures = [];

    public function __construct($db, $currentCourseId)
    {
        $this->db = $db;
        $this->currentCourseId = $currentCourseId;
        $this->getLecturesFromDb();
    }

    private function getLecturesFromDb()
    {
        $lecturesTable = $this->db->getLectureTableName();
        $sql = "SELECT * FROM $lecturesTable WHERE course_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($this->currentCourseId));
        $lecs = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lecs as $i => $row) {
            $this->lectures[$i] = new Lecture($row['lecture_id'], $row['name']);
        }
    }

    public function addLecture($name): bool
    {
        $lectureTable = $this->db->getLectureTableName();;
        $sql = "INSERT INTO $lectureTable (name, course_id) VALUES (?,?)";
        $prep = $this->db->getConnection()->prepare($sql);

        return $prep->execute(array($name, $this->currentCourseId));
    }

    public function getLectures(): array
    {
        return $this->lectures;
    }
}