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

<?php
require_once __DIR__ . '/../database/lectureservice.php';
require_once __DIR__ . '/../database/db.php';

session_start();
$user = $_SESSION['user'];
if (!$user) {
    header("Location: login.php");
    exit;
}
$courseId = $_GET['courseId'];
$lectureService = new LectureService(Db::getInstance(), $courseId);
?>

<div>
    <label for="addLecture">Add a lecture:</label>
    <form id="addLectureForn" method="post">
        <label for="name">Lecture Name</label>
        <input type="text" name="name" required/><br>
        <input type="submit" value="Add lecture" />
    </form>
</div>

<?php
if ($_POST) {
    $name = $_POST['name'];
    if ($lectureService->addLecture($name)) {
        echo "<script>alert('Lecture added successfully!')</script>";
        $header = "Location: course.php?courseId=$courseId";
        header($header);
    } else {
        echo "<script>alert('Lecture add failed :(')</script>";
    }

}
?>

<h1>Lectures: </h1>

<?php

foreach ($lectureService->getLectures() as $lecture)
{
    $lectureName = $lecture->getName();
    $lectureId = $lecture->getLectureId();
    echo "<a href='lecture.php?lectureId=$lectureId'><h3>$lectureName</h3></a>";
}


?>

</body>
</html>

