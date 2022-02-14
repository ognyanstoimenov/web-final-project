<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- nly for datatables -->
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
</head>
<body>
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
$allstudents = $lpservice->getAllStudents();

if(isset($_SESSION['FILE_UPLOADED']))
{
    $textFile =  __DIR__ . '/../uploads/data.txt';

    $files = [];
    $files[] = $textFile;
    foreach($files as $file)
    {
        $fileStudents = [];
        $studentsAndDate = readLecturePortion($file);
        foreach($studentsAndDate[0] as $row => $data){
            $student = $lpservice->addStudent($data->getFirstName(), $data->getLastName());
            if(!in_array($student, $allstudents))
            {
                $allstudents[] = $student;
            }
            $fileStudents[] = $student;
        }
        $lpservice->addLecturePortion($studentsAndDate[1], $fileStudents);
    }
    unset($_SESSION['FILE_UPLOADED']);
}
?>

<form action="uploadFile.php" method="post" enctype="multipart/form-data">
    Choose attendance file:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

<table id="table_id" class="display">
    <thead>
    <tr>
        <th>Name</th>
        <?php
        $lecturePortionTimes = $lpservice->getStartTimeOfPortions();
        foreach ($lecturePortionTimes as $time) {
            $formatted = $time->format('H:i:s');
            echo "<th>$formatted</th>";
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($allstudents as $student)
        {
            $firstName = $student->getFirstName();
            $lastName = $student->getLastName();
            echo "<tr>";
            echo "<td>$firstName $lastName</td>";
            $lecturePortions = $lpservice->getLecturePortions();
            foreach ($lecturePortions as $lecturePortion) {
                if($lecturePortion->hasStudentAttended($student))
                {
                    echo "<td style='background-color: green'><p hidden>a</p> </td>";
                }
                else {
                    echo "<td style='background-color: red'><p hidden>b</p></td>";
                }
            }
        }
    ?>
    </tbody>
</table>
</body>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
</html>
