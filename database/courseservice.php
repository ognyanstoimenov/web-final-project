<?php
require_once __DIR__ . '/../models/course.php';
class CourseService {
    private Db $db;
    private User $currentUser;

    private array $courses;

    public function __construct($db, $currentUser)
    {
        $this->db = $db;
        $this->currentUser = $currentUser;
        $this->getCoursesFromDb();
    }

    public function addCourse($courseName, $courseTypeStr): bool
    {
        $coursesTable = $this->db->getCourseTableName();
        $currentUserId = $this->currentUser->getId();
        $sql = "INSERT INTO $coursesTable (name, course_type, user_id) VALUES (?,?,?)";
        $prep = $this->db->getConnection()->prepare($sql);

        return $prep->execute(array($courseName, $courseTypeStr, $currentUserId));
    }

    private function getCoursesFromDb() {
        $coursesTable = $this->db->getCourseTableName();
        $currentUserId = $this->currentUser->getId();
        $sql = "SELECT * FROM $coursesTable WHERE user_id=?";
        $prep = $this->db->getConnection()->prepare($sql);
        $prep->execute(array($currentUserId));
        $lecs = $prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lecs as $i => $row) {
            $this->courses[$i] = new Course($row['course_id'], $row['name'], $row['course_type']);
        }
    }

    public function getCourses() : array
    {
        return $this->courses;
    }
}