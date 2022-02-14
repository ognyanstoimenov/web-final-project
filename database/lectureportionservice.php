<?php

class LecturePortionService
{
    private Db $db;
    private int $currentLectureId;

    private array $lecturePortions;

    public function __construct($db, $currentLectureId)
    {
        $this->db = $db;
        $this->currentLectureId = $currentLectureId;
    }

    private function getLecturePortionsFromDb()
    {
        $lecturePortionsTable = $this->db->getLecturePortionTableName();
        $sql = "SELECT * FROM $lecturePortionsTable WHERE lecture_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($this->currentLectureId));
        $lecs = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lecs as $i => $row) {

            $lecturePoriton = new LecturePortion()
        }
    }


    private function getStudentsForLecturePortion($lecturePortionId)
    {
        $junctionTable = $this->db->getJunctionTableName();
        $sql = "SELECT * FROM $junctionTable WHERE lecture_portion_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($lecturePortionId));
        $studentIds = $prep->fetchAll(PDO::FETCH_ASSOC);


        $students = [];
        foreach ($studentIds as $i => $studentId) {
            $studentsTable = $this->db->getStudentTableName();
            $sql = "SELECT * FROM $studentsTable WHERE student_id=?";
            $prep = $this->db->getConnection()->prepare($sql);
            $prep->execute(array($studentId));
            $student = $prep->fetch(PDO::FETCH_ASSOC);
            $students[$i] =
        }

    }

}