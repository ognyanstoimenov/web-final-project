<?php
require_once __DIR__ . '/../models/lectureportion.php';
class LecturePortionService
{
    private Db $db;
    private int $currentLectureId;

    private array $lecturePortions;

    public function __construct($db, $currentLectureId)
    {
        $this->db = $db;
        $this->currentLectureId = $currentLectureId;
        $this->getLecturePortionsFromDb();
    }


    public function getLecturePortions()
    {
        return $this->lecturePortions;
    }

    private function getLecturePortionsFromDb()
    {
        $lecturePortionsTable = $this->db->getLecturePortionTableName();
        $sql = "SELECT * FROM $lecturePortionsTable WHERE lecture_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($this->currentLectureId));
        $lecs = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lecs as $i => $row) {
            $lecturePortionId = $row['lecture_portion_id'];
            $students = $this->getStudentsForLecturePortion($lecturePortionId);
            $date = $row['date'];
            $lecturePortion = new LecturePortion($lecturePortionId, $students, DateTime::createFromFormat("Y-m-d H:i:s", $date));
            $this->lecturePortions[$i] = $lecturePortion;
        }
    }

    // Use this after file is parsed.
    public function addLecturePortion($date, $students)
    {
        $lecturePortionsTable = $this->db->getLecturePortionTableName();
        $sql = "INSERT INTO $lecturePortionsTable (date, lecture_id) VALUES (?, ?)";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($date, $this->currentLectureId));
        $lecturePortionId = $this->db->getConnection()->lastInsertId();
        $junctionTable = $this->db->getJunctionTableName();
        foreach ($students as $student)
        {
            $sql = "INSERT INTO $junctionTable (student_id, lecture_portion_id) VALUES (?,?)";
            $prep = $this->db->getConnection()->prepare($sql);
            $prep->execute(array($student->getStudentId(), $lecturePortionId));
        }
        $this->lecturePortions[] = new LecturePortion($lecturePortionId, $students, DateTime::createFromFormat("Y-m-d H:i:s", $date));
    }

    public function addStudent($firstName, $lastName) : Student|false
    {
        $studentsTable = $this->db->getStudentTableName();
        $sql = "INSERT INTO $studentsTable (firstname, lastname) VALUES (?,?)";
        $prep = $this->db->getConnection()->prepare($sql);
        if ($prep->execute(array($firstName, $lastName)))
        {
            $id = $this->db->getConnection()->lastInsertId();
            return new Student($id, $firstName, $lastName);
        }
        return false;
    }

    private function getStudentsForLecturePortion($lecturePortionId)
    {
        $junctionTable = $this->db->getJunctionTableName();
        $studentsTable = $this->db->getStudentTableName();
        $sql = "SELECT * FROM $junctionTable INNER JOIN $studentsTable
                    ON $junctionTable.student_id=$studentsTable.student_id WHERE lecture_portion_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($lecturePortionId));
        $studentRows = $prep->fetchAll(PDO::FETCH_ASSOC);
        $students = [];
        foreach ($studentRows as $i => $row)
        {
            $students[$i] = new Student($row['student_id'], $row['firstname'], $row['lastname']);
        }

        return $students;

    }
}