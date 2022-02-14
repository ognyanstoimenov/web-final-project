<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div>
<?php
require_once __DIR__ . '/../database/lectureportionservice.php';
require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../models/student.php';
require_once __DIR__ . '/../attendanceFileParser.php';
session_start();
$user = $_SESSION['user'];
if (!$user) {
    header("Location: login.php");
    exit;
}

$lectureId = $_GET['lectureId'];
$lpservice = new LecturePortionService(Db::getInstance(), $lectureId);

//Test

//TODO: Populate from parsed file
$studentsAndDate = readLecturePortion('data.txt');
$students = [];
foreach($studentsAndDate[0] as $row => $data){
    $students[] = $lpservice->addStudent($data->getFirstName(),$data->getLastName());
}

$students[] = $lpservice->addStudent("ognqn", "vakarelski");

$lpservice->addLecturePortion($studentsAndDate[1], $students);


?>
</div>


</body>
</html>