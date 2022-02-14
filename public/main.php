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
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../database/courseservice.php';
require_once __DIR__ . '/../database/db.php';
session_start();
$user = $_SESSION['user'];
if (!$user) {
    header("Location: login.php");
    exit;
}
$email = $user->getEmail();

$courseService = new CourseService(Db::getInstance(), $user);
$courses = $courseService->getCourses();

echo "
<div class='content'>
    <h1>Logged in as $email</h1><br>
    <form id='logout' action='form.php' method='POST'>
        <input type='hidden' name='LOGOUT'/>
        <input type='submit' value='Log out'/>
    </form>
</div>
    <div>
"
?>
<label for="addCourse">Add a course:</label>
<form id="addCourseForm" method="post">
    <label for="name">Course Name</label>
    <input type="text" name="name" required/><br>
    <label for="courseType">Course Type: </label>
    <select name="courseType" id="courseType" required>
        <option value="Z">Задължителна</option>
        <option value="I">Избираема</option>
    </select><br>
    <input type="submit" value="Add course" />
</form>

<?php

if ($_POST) {
    $name = $_POST['name'];
    $courseType = $_POST['courseType'];
    if ($courseService->addCourse($name, $courseType))
    {
        echo "<script>alert('Course added successfully!')</script>";
        header('Location: main.php');
    }
    else {
        echo "<script>alert('Course add failed :(')</script>";
    }

}
?>


<h1>Courses:</h1>

<?php

foreach ($courses as $course) {
    $courseName = $course->getName();
    $courseType = $course->getCourseType();
    $courseId = $course->getCourseId();
    echo "<a href='course.php?courseId=$courseId'><h3>$courseName [$courseType->value]</h3></a>";
}


echo "</div>";
?>
</div>
</body>
</html>